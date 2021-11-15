# api-php-bots
API чат-ботов для мессенджеров «Viber», «Telegram», «Facebook».

Пример работы с API - Viber, (php/5.3.x):

use App\Socialnet\Viber\Api as ApiViber;

class App_Hubs_Chat_Xep_0071_system extends App_Hubs_Chat_Xep_Core
{

    CONST CHANNEL = 'hubs-viber';

    protected $_apiIm = null;

    private $response = null;
    private $sender = null;
    private $message = null;

    public function _initApiIm() {

        if ( !$this->_apiIm )
        {
            $_config = $this->dynamic()->getConfig('viber');

            $this->_apiIm = new ApiViber\Core(array(
                'account'  => array('token' => $_config['token'], 'callback' => $_config['callback']),
                'sender'  => array( 'name' => $_config['name'],   'avatar' => $_config['avatar'] )
            ));
        }
        return $this;
    }

    private function getApi($isreset = false) {
        if ( $isreset ) {
            $this->_apiIm = null;
        }
        return $this->_initApiIm()->_apiIm;
    }

    private function getSender() { // Event user
        return $this->sender ? $this->sender->toArray() : array();
    }

    private function getMessage() { // Event message
        return $this->message ? $this->message->toArray() : array();
    }
    
    public function responseMessager($dataIn = array() ) {
        list($_evEmit, $_dtNodes, $_dataEmit) = Xep_Core_Get_Cli_DataEmit($dataIn);

        $that = &$this;

        $_details = $this->dynamic()->dataDetails();    
    
        $this->response = ApiViber\Response::create($_details['body']);

        $this->getApi()->setResponse($this->response);

        $this->getApi()
            ->onError( function ($event) use ($that) {

                $that->onError($event);
            })
            ->onConversation( function ($event) use ($that) {

                $that->onConversation($event);
            })
            ->onSubscribe( function ($event) use ($that) {

                $that->onSubscribe($event);
            })
            ->onUnsubscribed( function ($event) use ($that) {

                $that->onUnsubscribed($event);
            })
            ->onText('|btn-click|s', function ($event) use ($that) {

                $that->onTextClick($event);
            })
            ->onText('|k\d+|is', function($event) use ($that) {

                $that->onTextKey($event);
            })
           ->on(function($event) use ($that) {

               $that->onEvent($event);
            });

        $this->getApi()->process();
        
        $this->response = null;
        $this->sender = null;
        $this->message = null;
        $this->_apiIm = null;
    }

    public function onEvent($event) {

        if ($event instanceof ApiViber\Event\Message) {

            $this->sender  = $event->getSender();
            $this->message = $event->getMessage();

            switch( $this->message->getType() ) {

                case ApiViber\Message\Type::URL:

                        $this->_messageAsUrl();
                    break;
                case ApiViber\Message\Type::FILE:

                        $this->_messageAsFile();
                    break;
                case ApiViber\Message\Type::VIDEO:

                        $this->_messageAsVideo();
                    break;
                case ApiViber\Message\Type::PICTURE:

                        $this->_messageAsPicture();
                    break;

                default:

                    $this->_messageAsText(KIND_USER);
            }

        } else if ($event instanceof ApiViber\Event\Webhook) {

        }

    }
    
}
