<?php

namespace App\Console\Commands;

use App\Models\Borrowing;
use Illuminate\Console\Command;

class MarkOverdueBorrowings extends Command
{
    protected $signature = 'borrowings:mark-overdue';

    protected $description = 'Flag unreturned borrowings past their due date as "late" and accrue penalties.';

    private const PENALTY_PER_DAY = 100;

    public function handle(): int
    {
        $overdue = Borrowing::whereNull('returned_at')
            ->where('due_at', '<', now())
            ->get();

        foreach ($overdue as $borrowing) {
            $daysLate = now()->diffInDays($borrowing->due_at);

            $borrowing->update([
                'status'         => 'late',
                'penalty_amount' => $daysLate * self::PENALTY_PER_DAY,
            ]);
        }

        $this->info("{$overdue->count()} emprunt(s) marqué(s) en retard.");

        return self::SUCCESS;
    }
}
