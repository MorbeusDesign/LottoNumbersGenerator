# LottoNumbersGenerator
Lotto Number Wizard Generator is a standalone PHP project crafted to blend fun with learning. It’s more than just a tool for generating lotto numbers—it's an engaging way for PHP beginners to dive into coding, develop simple algorithms, and grow their skills in a practical, hands-on manner.

## Key Features:
Unique Number Generation: Randomly generates 6 unique lotto numbers between 1 and 49, ensuring variety and unpredictability in every draw.
Smart Filtering: Enhances the quality of generated combinations by filtering out unlikely sequences, such as consecutive numbers or too many numbers from the same range group (1-9, 10-19, etc.).
Extra Number Inclusion: Adds an additional number between 0 and 9, tailored for lotto games that require an extra touch of luck.
User-Friendly Interface: Offers a simple, command-line interface that makes generating and displaying numbers straightforward and enjoyable.

## Learning Focus:
The primary goal of Lotto Number Generator is to support PHP learners in understanding and applying basic coding concepts through a practical, enjoyable project. Key learning outcomes include:

## Algorithm Development: Build and refine basic algorithms, such as random number generation and filtering techniques.
PHP Fundamentals: Gain hands-on experience with core PHP syntax, functions, and control structures.
Problem-Solving Skills: Enhance critical thinking by identifying and implementing effective solutions to optimize code performance.
Project-Based Learning: Work on a self-contained project that provides a clear, tangible outcome, making learning PHP both rewarding and relevant.
Lotto Number Wizard Generator is perfect for those at the start of their PHP journey, offering a blend of utility and entertainment that keeps learning engaging and rewarding. Dive in, have fun, and let your coding skills grow alongside your chances of picking those lucky numbers!
___

# Lotto (German Version) 6 out of 49 - Program Overview & Explanation:
The Lotto Game in Germany, also known as "Lotto 6 aus 49," is one of the most popular lotteries in the country and has been around since 1955. It is a game of chance where participants select 6 numbers from a pool of 1 to 49. Additionally, an extra number ("Superzahl") between 0 and 9 is drawn.

## How does it work?

Number Selection: Players choose 6 numbers from a range of 1 to 49.
Extra Number (or Superzahl): Additionally, a extra number between 0 and 9 is randomly assigned or chosen by the player.
Draws: Draws take place on Wednesdays and Saturdays, where 6 winning numbers and a Superzahl are drawn.
Prize Categories: There are 9 prize categories in total, with the jackpot being the highest. To win the jackpot, all 6 numbers plus the Superzahl must be correctly matched.
Odds of Winning: The probability of winning the jackpot (6 correct numbers + extra Number or Superzahl) is approximately 1 in 140 million.

**Here's the complete PHP program for the Lotto Number Wizard Generator, followed by a step-by-step explanation:**

```php
<?php 

function generateLottoNumbers() { 
    do {
        $lottoNumbers = generateUniqueNumbers(6, 1, 49);
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
    $groups = [
        '1-9' => 0,
        '10-19' => 0,
        '20-29' => 0,
        '30-39' => 0,
        '40-49' => 0,
    ];

    foreach ($numbers as $number) {
        if ($number <= 9) {
            $groups['1-9']++;
        } elseif ($number <= 19) {
            $groups['10-19']++;
        } elseif ($number <= 29) {
            $groups['20-29']++;
        } elseif ($number <= 39) {
            $groups['30-39']++;
        } else {
            $groups['40-49']++;
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
```

### Step-by-Step Explanation

#### 1. `generateLottoNumbers()`

```php
function generateLottoNumbers() { 
    do {
        $lottoNumbers = generateUniqueNumbers(6, 1, 49);
    } while (isUnlikelyCombination($lottoNumbers));

    return $lottoNumbers; 
}
```

- **Purpose:** This function generates a set of 6 unique lotto numbers between 1 and 49. 
- **How it works:** It calls `generateUniqueNumbers()` to get the initial set of numbers, then checks the set using `isUnlikelyCombination()`. If the set is deemed unlikely (e.g., contains consecutive numbers or too many numbers from the same group), it regenerates the set until it finds a suitable combination.

#### 2. `generateUniqueNumbers($quantity, $min, $max)`

```php
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
```

- **Purpose:** Generates a specified quantity of unique random numbers within a given range.
- **How it works:** It uses a loop to generate random numbers until the desired quantity is reached, checking each time to ensure the number isn’t already in the array. The numbers are then sorted in ascending order.

#### 3. `isUnlikelyCombination(array $numbers): bool`

```php
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
```

- **Purpose:** Evaluates if a combination of numbers is unlikely to win based on predefined criteria.
- **How it works:** It uses `groupNumbers()` to group numbers into specific ranges and checks if any group has more than 2 numbers. It also checks for consecutive numbers using `hasConsecutiveNumbers()`.

#### 4. `groupNumbers(array $numbers): array`

```php
function groupNumbers(array $numbers): array {
    $groups = [
        '1-9' => 0,
        '10-19' => 0,
        '20-29' => 0,
        '30-39' => 0,
        '40-49' => 0,
    ];

    foreach ($numbers as $number) {
        if ($number <= 9) {
            $groups['1-9']++;
        } elseif ($number <= 19) {
            $groups['10-19']++;
        } elseif ($number <= 29) {
            $groups['20-29']++;
        } elseif ($number <= 39) {
            $groups['30-39']++;
        } else {
            $groups['40-49']++;
        }
    }

    return $groups;
}
```

- **Purpose:** Groups numbers into specified ranges.
- **How it works:** Iterates through the given numbers, incrementing the count for the appropriate range (e.g., 1-9, 10-19). This helps in identifying whether too many numbers fall within the same group.

#### 5. `hasConsecutiveNumbers(array $numbers): bool`

```php
function hasConsecutiveNumbers(array $numbers): bool {
    for ($i = 0, $len = count($numbers) - 1; $i < $len; $i++) {
        if ($numbers[$i] + 1 === $numbers[$i + 1]) {
            return true;
        }
    }

    return false;
}
```

- **Purpose:** Checks if the generated numbers contain consecutive values.
- **How it works:** Iterates through the sorted array and checks if any adjacent numbers are consecutive. Returns `true` if a pair is found.

#### 6. `generateExtraNumber(): int`

```php
function generateExtraNumber(): int { 
    return rand(0, 9); 
}
```

- **Purpose:** Generates an additional random number between 0 and 9, often required in lotto games as a "bonus" or "extra" number.
- **How it works:** Simply uses `rand()` to generate the number 🍀.

#### 7. `displayLottoResults(array $lottoNumbers, int $extraNumber): void`

```php
function displayLottoResults(array $lottoNumbers, int $extraNumber): void { 
    echo "Lotto numbers: " . implode(", ", $lottoNumbers) . "\n"; 
    echo "Extra number: " . $extraNumber . "\n"; 
}
```

- **Purpose:** Displays the generated lotto numbers and the extra number.
- **How it works:** Uses `implode()` to format the numbers into a string and prints the results to the console.

### Execution

```php
// Execute the draw
$lottoNumbers = generateLottoNumbers(); 
$extraNumber = generateExtraNumber(); 

// Display the results
displayLottoResults($lottoNumbers, $extraNumber);
```
___
# How to Adapt the Program for Different Lotteries

To customize the functionality of the **Lotto Number Generator**, you can modify the `generateLottoNumbers()` function and adapt the `groupNumbers()` function to tailor the number generation and filtering process according to different rules or requirements.

### Modifying `generateLottoNumbers()`

The `generateLottoNumbers()` function currently generates 6 unique numbers between 1 and 49, ensuring they meet specific criteria (like avoiding consecutive numbers or too many numbers from the same range). You can adjust this function to change the quantity of numbers, the range, or the filtering criteria. 

**For example:**
- **Change the number range:** Modify the call to `generateUniqueNumbers()` to adjust the minimum and maximum values. This could be useful if you want a different lotto format, like picking from 1 to 60 instead of 1 to 49.
- **Change the number of picks:** If the game rules change, you can easily modify the `$quantity` parameter to pick more or fewer numbers.
- **Adjust filtering rules:** You can add or remove calls to filtering functions like `isUnlikelyCombination()` if you want different criteria for what counts as a valid combination.

### Adapting `groupNumbers()`

The `groupNumbers()` function groups the numbers into predefined ranges (1-9, 10-19, etc.). This helps in checking whether too many numbers fall within the same range, which is one of the current filtering criteria. 

**To adapt `groupNumbers()`:**
- **Change the range groups:** Modify the ranges to match different lotto rules. For instance, you could create larger or smaller groups depending on the desired game structure.
- **Add more detailed groups:** If needed, you can break down the ranges further or introduce new groupings based on specific game rules.
- **Customize grouping logic:** The current function counts how many numbers fall into each range. You could extend this to include additional checks, such as ensuring that there are exactly two numbers in each group or that certain groups must be represented.

### Example of Changes

If you want to adapt the generator for a different lotto game that selects 5 numbers from 1 to 60, and you want groups to be by every 15 numbers (1-15, 16-30, etc.), you would:

1. **Modify `generateLottoNumbers()` to call:**
   ```php
   $lottoNumbers = generateUniqueNumbers(5, 1, 60);
   ```
   
2. **Adapt `groupNumbers()` to new ranges:**
   ```php
   function groupNumbers(array $numbers): array {
       $groups = [
           '1-15' => 0,
           '16-30' => 0,
           '31-45' => 0,
           '46-60' => 0,
       ];

       foreach ($numbers as $number) {
           if ($number <= 15) {
               $groups['1-15']++;
           } elseif ($number <= 30) {
               $groups['16-30']++;
           } elseif ($number <= 45) {
               $groups['31-45']++;
           } else {
               $groups['46-60']++;
           }
       }

       return $groups;
   }
   ```

### Conclusion

By adjusting `generateLottoNumbers()` and `groupNumbers()`, you can easily adapt the Lotto Number Wizard Generator to fit different lotto formats and game rules. This flexibility allows you to experiment with various algorithms and criteria, making it an excellent exercise for understanding how to structure logic and data handling in PHP.







