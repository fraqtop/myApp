<?php


namespace App\Services;

use Carbon\Carbon;
use Illuminate\Http\Request;
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

    public function isSpam(Request $request): bool
    {
        $request->validate([
            'contactAuthor' => 'required',
            'contactMessage' => 'required',
        ]);
        if ($request->filled('contactAdvanced') || !$request->has('contactTime')) {
            $this->registerSpamMessage($request->post('contactAuthor'), [$request->post('contactAdvanced')]);
            return true;
        }
        $postingPeriod = Carbon::now()->timestamp - $request->post('contactTime');
        $keyPressDiff = $request->post('contactCounter') - strlen($request->post('contactMessage'));
        if($postingPeriod < 5 || $keyPressDiff < -20)
        {
            $traps = [$postingPeriod, $keyPressDiff];
            $this->registerSpamMessage($request->post('contactAuthor'), $traps);
            return true;
        }
        return false;
    }

    private function registerSpamMessage(string $spamName, array $trapsValues)
    {
        $log = fopen("spamlog.txt", 'a+');
        $time = new \DateTime();
        fwrite($log, $spamName." - ".$time->format('d M Y H:i'));
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