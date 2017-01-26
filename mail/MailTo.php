<?php
/**
 * Created by PhpStorm.
 * User: Maestro
 * Date: 11/12/2015
 * Time: 10:53 AM
 */

class MailTo {

    protected $to;
    protected $subject;
    protected $body;
    protected $headers;
    protected $data;


    public function __construct()
    {
        $this->to = 'chris@plasmicmedia.com';
        $this->subject = 'Vivamus fermentum semper porta.';
        $this->body = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a diam lectus. Sed sit amet ipsum mauris. Maecenas congue ligula ac quam viverra nec consectetur ante hendrerit. Donec et mollis dolor. Praesent et diam eget libero egestas mattis sit amet vitae augue. Nam tincidunt congue enim, ut porta lorem lacinia consectetur. Donec ut libero sed arcu vehicula ultricies a non tortor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ut gravida lorem. Ut turpis felis, pulvinar a semper sed, adipiscing id dolor. Pellentesque auctor nisi id magna consequat sagittis. Curabitur dapibus enim sit amet elit pharetra tincidunt feugiat nisl imperdiet. Ut convallis libero in urna ultrices accumsan. Donec sed odio eros. Donec viverra mi quis quam pulvinar at malesuada arcu rhoncus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In rutrum accumsan ultricies. Mauris vitae nisi at sem facilisis semper ac in est.';
        $this->headers = 'MIME-Version: 1.0' ."\r\n";
        $this->headers .= 'Content-type:text/html;charset=UTF-8'."\r\n";
        $this->headers .= 'From: Plasmic Media <support@plasmicmedia.com>'."\r\n";
    }

    public function sendMail()
    {
        if (mail($this->to, $this->subject, $this->body, $this->headers)) {
            echo "MAIL - OK";
        } else {
            echo "MAIL FAILED";

        }
        $this->data = [
            'to' => $this->to,
            'subject' => $this->subject,
            'body' => $this->body,
            'headers' => $this->headers
        ];
        echo $this->to;
    }
}
