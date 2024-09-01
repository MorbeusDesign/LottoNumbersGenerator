<?php 

function generateLottoNumbers() { 
    do {
        // Generate 5 unique numbers between 1 and 90
        $lottoNumbers = generateUniqueNumbers(5, 1, 90);
    } while (isUnlikelyCombination($lottoNumbers));

    return $lottoNumbers; 
}

function generateUniqueNumbers($quantity, $min, $max) {
    $numbers = [];

    while (count($numbers) < $quantity) { 
        $randomNumber = rand($min, $max); 
        if (!in_array($randomNumber, $numbers)) { 
            $numbers[] = $randomNumber; 
        } 
    } 

    sort($numbers); 
    return $numbers;
}

function isUnlikelyCombination(array $numbers): bool {
    $groups = groupNumbers($numbers);

    // Check if any group has more than 2 numbers
    foreach ($groups as $count) {
        if ($count > 2) {
            return true;
        }
    }

    // Check for consecutive numbers
    return hasConsecutiveNumbers($numbers);
}

function groupNumbers(array $numbers): array {
    // Adjusted groups to match the range 1-90
    $groups = [
        '1-18' => 0,
        '19-36' => 0,
        '37-54' => 0,
        '55-72' => 0,
        '73-90' => 0,
    ];

    foreach ($numbers as $number) {
        if ($number <= 18) {
            $groups['1-18']++;
        } elseif ($number <= 36) {
            $groups['19-36']++;
        } elseif ($number <= 54) {
            $groups['37-54']++;
        } elseif ($number <= 72) {
            $groups['55-72']++;
        } else {
            $groups['73-90']++;
        }
    }

    return $groups;
}

function hasConsecutiveNumbers(array $numbers): bool {
    for ($i = 0, $len = count($numbers) - 1; $i < $len; $i++) {
        if ($numbers[$i] + 1 === $numbers[$i + 1]) {
            return true;
        }
    }

    return false;
}

function generateExtraNumber(): int { 
    return rand(0, 9); 
}

function displayLottoResults(array $lottoNumbers, int $extraNumber): void { 
    echo "Lotto numbers: " . implode(", ", $lottoNumbers) . "\n"; 
    echo "Extra number: " . $extraNumber . "\n"; 
}

// Execute the draw
$lottoNumbers = generateLottoNumbers(); 
$extraNumber = generateExtraNumber(); 

// Display the results
displayLottoResults($lottoNumbers, $extraNumber);

?>
