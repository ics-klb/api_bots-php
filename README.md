# api-php-bots
API чат-ботов для мессенджеров «Viber», «Telegram», «Facebook».

Внедрение на базе системы «KoloBizCom» чат-ботов в мессенджерах: «Viber», «Telegram»  и «Facebook» для потребителей услуги по обращению в Контакт центр. Чат-бот позволяет искать информацию по базе данных FAQ и  для этого достаточно в относительно свободной форме выполнить запрос с указанием данных, которые необходимо найти.
1.1. Наименование системы и её условное обозначение
Чат-бот для потребителей услуги по обращению в Контакт-центр.
1.2. Наименование работ
Разработка и внедрение чат-бота для потребителей услуги по обращению в Контакт центр для мессенджеров  «Viber», «Telegram»,  «Facebook».
1.3. Цели проекта
Целью проекта является разработка и внедрение чат-ботов для мессенджеров «Viber», «Telegram», «Facebook», которые обеспечат подачу обращений клиентов, обеспечат пользователей информационной услугой по интересующих их вопросам  (включая возможность добавления фото), а также информирование о реализуемых услугах и контактной информации.
1.4. Задачи проекта
1. автоматизация процесса приема и обработки обращений от клиентов Заказчика;
2. разработка системы управления интерфейсом чат-бота;
3. создание механизма информационного взаимодействия между мультиканальным чат-ботом и CRM системой для персонализации пользователя, отправки информационных, рекламных  сообщений;
1.5. Назначение Системы ChatBots
Основным назначением Системы является автоматизированный прием и обработка  обращений граждан, выявления интересов клиентов, а так же уменьшение нагрузки на операторов контакт-центра.
1.5. Цели создания Системы ChatBots
Основной целью создания Системы ChatBots является предоставление потребителям услуги  удобного и бесплатного сервиса, позволяющего оперативно получать ответы на интересующие его вопросы, повысить внимание пользователей к услугам Банка и оперативно информировать клиентов о продвигаемых продуктах.
1.6. Задачи Системы ChatBots
1. Обеспечить взаимодействие с социальными платформами «Viber», «Telegram», «Facebook» на основе общедоступного Api (ChatBots-Hub).
2. Предоставить потребителю оценивать работу робота с помощью элементов оценки голосования или like, dislike, выставление оценки.
3. Функционал чат-бота должен предусматривать возможность создавать триггеры событий на вопросы, поставленные роботу (голосование по тематикам с ограничением по срокам принятия решений).
4. Функционал чат-бота должен предусматривать предварительную обработку естественного языка запроса пользователя  - на основе методов Natural Language Processing (NLP) для повышения отзывчивости робота на вопросы клиентов.
5. Функционал чат-бота должен предусматривать возможность сбора и обработки статистических данных, а также дальнейшее обучение чат-бота;
6. Применение Neural Language Models для решения поставленных логически взвешенных задач.

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
