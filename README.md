# 👋 Vocative

### #StandWithUkraine 🇺🇦

**Vocative** is a PHP library that convert names to vocative in ukrainian language.

> Vocative requires PHP >= 5.6.

# Table of Contents

- **Instalation**
- **Usage**
- **Rules**
  - Simple case
  - Male rules
  - Female rules
- **License**

## Instalation

**Vocative** is available on [Packagist](https://packagist.org/).
Installation via `Composer` is the recommended way:

```sh
composer require bstepanenko/vocative
```

```php
<?php
require_once 'vendor/autoload.php';
```

## Usage

Use `Vocative` to create instance and call `convertToVocative()` :

```php
/**
 * @param integer $gender Gender (male = 1, female = 2)
 * @param string $name Name to convert
 * @return string $vocative Vocative name in ukrainian
 */
$vocative = new Vocative(1, "Олег");
$vocative_name = $vocative->convertToVocative();
echo $vocative_name;
```

Output:

```sh
Олеже
```

## Rules

### Simple case 👦+👧

| Last letter | Male vocative | Female vocative |
| :---------: | :-----------: | :-------------: |
|  **а** (А)  |   **о** (О)   |    **о** (О)    |

### Male rules 👦

|  Last letter  |  Vocative   |     Example      |
| :-----------: | :---------: | :--------------: |
| **Consonant** |  **е** (Е)  |  Ігор -> Ігоре   |
|   **г** (Г)   | **же** (ЖЕ) |  Олег -> Олеже   |
|   **й** (Й)   |  **ю** (Ю)  | Сергій -> Сергію |
|   **я** (Я)   |  **е** (Е)  |   Ілля -> Ілле   |

### Female rules 👧

| Penultimate letter | Last letter | Vocative  |   Example    |
| :----------------: | :---------: | :-------: | :----------: |
|   **Consonant**    |  **я** (я)  | **е** (Е) | Зоря -> Зоре |
|     **Vowel**      |  **я** (я)  | **є** (Є) | Юлія -> Юліє |

## License

MIT License.
