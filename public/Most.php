<?php
abstract class Notification
{
    protected $notificationSender;
    public function __construct(NotificationSender $sender)
    {
        $this->notificationSender = $sender;
    }
    abstract public function send(): void;
}
interface NotificationSender
{
    public function send(string $message): void;
}

class EmailNotificationSender implements NotificationSender
{
    public function send(string $message): void
    {
        echo "Отправка уведомления по электронной почте: $message\n";
    }
}

class SMSNotificationSender implements NotificationSender
{
    public function send(string $message): void
    {
        echo "Отправка SMS-уведомления: $message\n";
    }
}

class MessengerNotificationSender implements NotificationSender
{
    public function send(string $message): void
    {
        echo "Отправка уведомления через мессенджер: $message\n";
    }
}
class SimpleNotification extends Notification
{
    public function send(): void
    {
        $this->notificationSender->send("Простое уведомление");
    }
}

class ErrorNotification extends Notification
{
    public function send(): void
    {
        $this->notificationSender->send("Уведомление об ошибке");
    }
}

class UrgentNotification extends Notification
{
    public function send(): void
    {
        $this->notificationSender->send("Срочное уведомление");
    }
}

// Использование паттерна Мост
$emailSender = new EmailNotificationSender();
$smsSender = new SMSNotificationSender();
$messengerSender = new MessengerNotificationSender();

$simpleEmailNotification = new SimpleNotification($emailSender);
$simpleEmailNotification->send();

$errorSMSNotification = new ErrorNotification($smsSender);
$errorSMSNotification->send();

$urgentMessengerNotification = new UrgentNotification($messengerSender);
$urgentMessengerNotification->send();