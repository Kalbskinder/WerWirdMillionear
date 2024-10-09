<?php

/**
 * Abschlussauftrag Onlineshopping
 *
 * @author Kalbskinder
 * @copyright Copyright (c) 2024, Kalbskinder
 * @version 1.0
 *
 */

// Declare variables
$status = 'playing';
$id = '1';
$checkout_money = '0';

// Load JSON file
$jsonData = file_get_contents('arrays.json');
$data = json_decode($jsonData, true);

// Extract arrays from JSON data
$questions = $data['questions'];
$correct_answer = $data['answers'];
$prizes = $data['prizes'];

// Print welcome
print("------------------------------------------------\n");
print("             Wer wird Millionär\n");
print("------------------------------------------------\n\n\n");

// While ingame loop
while ($status == 'playing') {
    print("\n??? --  CHF {$prizes[$id]}.- Frage --  ???\n\n");

    print("{$questions[$id]}");

    print("\n\n(A) - (D) Antworten | (E) Austeigen\n");
    $input = strtolower(readline('Antwort: '));

// Check if the input is valid
    if ($input == 'a' || $input == 'b' || $input == 'c' || $input == 'd' || $input == 'e') {
        switch ($input) {
            case 'e':
                $status = 'exited';
                $id--;
                $checkout_money = $prizes[$id];
                print("---- Aufgehört ----\nWow! Du hast CHF $checkout_money.- gewonnen!\nDie richtige Antwort wäre: (" . strtoupper($correct_answer[$id]) . ")\n\n");
                break;

            default:
// Check if input is correct
                if ($input == $correct_answer[$id]) {
                    if ($id == 15) {
                        print("\n\nWOW! Du hast die CHF 1,000,000.- gewonnen!\n\n");
                        $status = 'won';
                        break;
                    }
                    $id++;
                } else {
                    $checkout_money = '0';
                    $status = 'left';
// Checkpoint money
                    if ($id >= '11') {
                        $checkout_money = '16,000';
                    } elseif ($id >= '6') {
                        $checkout_money = '500';
                    } else {
                        $checkout_money = '0';
                    }

                    print("Du hast die Frage nicht richtig beantwortet...\nDie richtige Antwort lautet: (" . strtoupper($correct_answer[$id]) . ")\nDu hast CHF $checkout_money.- gewonnen.\n\n");
                }
                break;
        }
    } else {
        print("\n\nDas ist keine korrekte Eingabe!\n\n");
    }
}
