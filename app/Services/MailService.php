<?php


namespace App\Services;

use Mail;
use App\Mail\{ContactMail, ErrorReportMail};

class MailService
{
    private $users;

    private function getMailable(array $data)
    {
        if (isset($data['contactAuthor']) && isset($data['contactMessage'])) {
            return new ContactMail(
                $data['contactAuthor'],
                $data['contactMessage'],
                $data['contactFeedback'] ?? null
            );
        }
        if (isset($data['message']) && isset($data['file'])) {
            return new ErrorReportMail($data['message'], $data['file']);
        }
        return null;
    }

    public function send($data, $userId = 1)
    {
        $mail = $this->getMailable($data);
        if ($mail) {
            Mail::to($this->users->get($userId))->send($mail);
            return true;
        }
        return false;
    }

    public function isSpam($input): bool
    {
        $fakeField = $input['contactAdvanced'] ?? null;
        $postingPeriod = (new \DateTime())->getTimestamp() - $input['contactTime'];
        $keyPressDiff = (int)$input['contactCounter'] - strlen($input['contactMessage']);
        if($fakeField != null || $postingPeriod < 5 || $keyPressDiff < -20)
        {
            $traps = [$fakeField, $postingPeriod, $keyPressDiff];
            $this->registerSpamMessage($input['contactAuthor'], $traps);
            return true;
        }
        return false;
    }

    private function registerSpamMessage(string $spamName, array $trapsValues)
    {
        $log = fopen("spamlog.txt", 'a+');
        $time = new \DateTime();
        fwrite($log, $spamName." - ".$time->format('d M Y H:i'));
        if (strlen($trapsValues[0])>10)
            $trapsValues[0] = 'garbage';
        foreach ($trapsValues as $trap)
        {
            fwrite($log, " ".$trap." ");
        }
        fwrite($log, PHP_EOL);
        fclose($log);
    }

    public function __construct(UserService $userService)
    {
        $this->users = $userService;
    }
}