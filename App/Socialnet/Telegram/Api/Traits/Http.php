<?php

namespace App\Socialnet\Telegram\Api\Traits;

use App\Socialnet\Telegram\Api\Exceptions\CouldNotUploadInputFile;
use App\Socialnet\Telegram\Api\Exceptions\CoreSDKException;
use App\Socialnet\Telegram\Api\FileUpload\InputFile;
use App\Socialnet\Telegram\Api\HttpClients\HttpClientInterface;
use App\Socialnet\Telegram\Api\Client;
use App\Socialnet\Telegram\Api\Request;
use App\Socialnet\Telegram\Api\Response;

/**
 * Http.
 */
trait Http
{
    use Validator;

    /** @var string Telegram Bot API Access Token. */
    protected $accessToken = null;

    /** @var Client The Telegram client service. */
    protected $client = null;

    /** @var HttpClientInterface|null Http Client Handler */
    protected $httpClientHandler = null;

    /** @var bool Indicates if the request to Telegram will be asynchronous (non-blocking). */
    protected $isAsyncRequest = false;

    /** @var int Timeout of the request in seconds. */
    protected $timeOut = 60;

    /** @var int Connection timeout of the request in seconds. */
    protected $connectTimeOut = 10;

    /** @var Response|null Stores the last request made to Telegram Bot API. */
    protected $lastResponse;

    /**
     * Set Http Client Handler.
     *
     * @param HttpClientInterface $httpClientHandler
     *
     * @return $this
     */
    public function setHttpClientHandler(HttpClientInterface $httpClientHandler)
    {
        $this->httpClientHandler = $httpClientHandler;

        return $this;
    }

    /**
     * Returns the Client service.
     *
     * @return Client
     */
    protected function getClient()
    {
        if ($this->client === null) {
            $this->client = new Client($this->httpClientHandler);
        }

        return $this->client;
    }

    /**
     * Returns the last response returned from API request.
     *
     * @return Response|null
     */
    public function getLastResponse()
    {
        return $this->lastResponse;
    }

    /**
     * Returns Telegram Bot API Access Token.
     *
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * Sets the bot access token to use with API requests.
     *
     * @param string $accessToken The bot access token to save.
     *
     * @return $this
     */
    public function setAccessToken(string $accessToken)
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    /**
     * Check if this is an asynchronous request (non-blocking).
     *
     * @return bool
     */
    public function isAsyncRequest()
    {
        return $this->isAsyncRequest;
    }

    /**
     * Make this request asynchronous (non-blocking).
     *
     * @param bool $isAsyncRequest
     *
     * @return $this
     */
    public function setAsyncRequest(bool $isAsyncRequest)
    {
        $this->isAsyncRequest = $isAsyncRequest;

        return $this;
    }

    /**
     * @return int
     */
    public function getTimeOut()
    {
        return $this->timeOut;
    }

    /**
     * @param int $timeOut
     *
     * @return $this
     */
    public function setTimeOut(int $timeOut)
    {
        $this->timeOut = $timeOut;

        return $this;
    }

    /**
     * @return int
     */
    public function getConnectTimeOut()
    {
        return $this->connectTimeOut;
    }

    /**
     * @param int $connectTimeOut
     *
     * @return $this
     */
    public function setConnectTimeOut(int $connectTimeOut)
    {
        $this->connectTimeOut = $connectTimeOut;

        return $this;
    }

    /**
     * Sends a GET request to Telegram Bot API and returns the result.
     *
     * @param string $endpoint
     * @param array  $params
     *
     * @throws CoreSDKException
     *
     * @return Response
     */
    protected function get(string $endpoint, array $params = array() )
    {
        $params = $this->replyMarkupToString($params);

        return $this->sendRequest('GET', $endpoint, $params);
    }

    /**
     * Sends a POST request to Telegram Bot API and returns the result.
     *
     * @param string $endpoint
     * @param array  $params
     * @param bool   $fileUpload Set true if a file is being uploaded.
     *
     * @throws CoreSDKException
     * @return Response
     */
    protected function post(string $endpoint, array $params = array(), $fileUpload = false)
    {
        $params = $this->normalizeParams($params, $fileUpload);

        return $this->sendRequest('POST', $endpoint, $params);
    }

    /**
     * Converts a reply_markup field in the $params to a string.
     *
     * @param array $params
     *
     * @return array
     */
    protected function replyMarkupToString(array $params)
    {
        if (isset($params['reply_markup'])) {
            $params['reply_markup'] = (string) $params['reply_markup'];
        }

        return $params;
    }

    /**
     * Sends a multipart/form-data request to Telegram Bot API and returns the result.
     * Used primarily for file uploads.
     *
     * @param string $endpoint
     * @param array  $params
     * @param string $inputFileField
     *
     * @throws CouldNotUploadInputFile
     *
     * @return Response
     */
    protected function uploadFile(string $endpoint, array $params, $inputFileField)
    {
        //Check if the field in the $params array (that is being used to send the relative file), is a file id.
        if (! isset($params[$inputFileField])) {
            throw CouldNotUploadInputFile::missingParam($inputFileField);
        }

        if ($this->hasFileId($inputFileField, $params)) {
            return $this->post($endpoint, $params);
        }

        //Sending an actual file requires it to be sent using multipart/form-data
        return $this->post($endpoint, $this->prepareMultipartParams($params, $inputFileField), true);
    }

    /**
     * Prepare Multipart Params for File Upload.
     *
     * @param array  $params
     * @param string $inputFileField
     *
     * @throws CouldNotUploadInputFile
     *
     * @return array
     */
    protected function prepareMultipartParams(array $params, $inputFileField)
    {
        $this->validateInputFileField($params, $inputFileField);

        //Iterate through all param options and convert to multipart/form-data.
        return collect($params)
            ->reject(function ($value) {
                return null === $value;
            })
            ->map(function ($contents, $name) {
                return $this->generateMultipartData($contents, $name);
            })
            ->values()
            ->all();
    }

    /**
     * Generates the multipart data required when sending files to telegram.
     *
     * @param mixed  $contents
     * @param string $name
     *
     * @return array
     */
    protected function generateMultipartData($contents, $name)
    {
        if (! $this->isInputFile($contents)) {
            return compact('name', 'contents');
        }

        $filename = $contents->getFilename();
        $contents = $contents->getContents();

        return compact('name', 'contents', 'filename');
    }

    /**
     * Sends a request to Telegram Bot API and returns the result.
     *
     * @param string $method
     * @param string $endpoint
     * @param array  $params
     *
     * @throws CoreSDKException
     *
     * @return Response
     */
    protected function sendRequest($method, $endpoint, array $params = array() )
    {
        $telegramRequest = $this->resolveTelegramRequest($method, $endpoint, $params);

        return $this->lastResponse = $this->getClient()->sendRequest($telegramRequest);
    }

    /**
     * Instantiates a new TelegramRequest entity.
     *
     * @param string $method
     * @param string $endpoint
     * @param array  $params
     *
     * @return Request
     */
    protected function resolveTelegramRequest($method, $endpoint, array $params = array() )
    {
        return (new Request(
            $this->getAccessToken(),
            $method,
            $endpoint,
            $params,
            $this->isAsyncRequest()
        ))
            ->setTimeOut($this->getTimeOut())
            ->setConnectTimeOut($this->getConnectTimeOut());
    }

    /**
     * @param array $params
     * @param $inputFileField
     *
     * @throws CouldNotUploadInputFile
     */
    protected function validateInputFileField(array $params, $inputFileField)
    {
        if (! isset($params[$inputFileField])) {
            throw CouldNotUploadInputFile::missingParam($inputFileField);
        }

        // All file-paths, urls, or file resources should be provided by using the InputFile object
        if ((! $params[$inputFileField] instanceof InputFile)
                || (is_string($params[$inputFileField]) && ! $this->is_json($params[$inputFileField])))
        {

            throw CouldNotUploadInputFile::inputFileParameterShouldBeInputFileEntity($inputFileField);
        }
    }

    /**
     * @param array $params
     * @param $fileUpload
     *
     * @return array
     */
    private function normalizeParams(array $params, $fileUpload)
    {
        if ($fileUpload) {
            return array('multipart' => $params);
        }

        return array('form_params' => $this->replyMarkupToString($params));
    }
}
