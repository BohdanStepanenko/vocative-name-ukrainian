<?php

/**
 * VOCATIVE NAME (UKRAINIAN)
 * 
 * Convert name to vocative form in ukrainian language
 * 
 * @param int gender type (male = 1, female = 2)
 * @param string name to convert
 * 
 * @return string vocative name
 * 
 * @author Bohdan Stepanenko
 * @version 1.0
 */

class Vocative
{
    protected const LETTERS_CONSONANT  = ['б', 'в', 'г', 'ґ', 'д', 'ж', 'з', 'к', 'л', 'м', 'н', 'п', 'р', 'с', 'т', 'ф', 'х', 'ц', 'ч', 'ш', 'щ'];
    protected const LETTERS_VOWEL = ['а', 'е', 'и', 'і', 'о', 'у', 'я', 'ю', 'є', 'ї'];

    protected int $gender;
    protected string $name;

    public function __construct($gender, $name)
    {
        $this->gender = $gender;
        $this->name = $name;
    }

    public function convertToVocative()
    {
        $last_char = substr($this->name, -1);

        if ($last_char == 'а') {
            // The same rules (simple case)
            $vocative_ending = str_replace('а', 'о', $last_char);
        } else {
            $penultimate_char = substr($this->name, -2);
            $vocative_ending = $this->getVocativeEnding($penultimate_char, $last_char);
        }

        $vocative_name = substr_replace($this->name, $vocative_ending, 1);

        return $vocative_name;
    }

    public function getVocativeEnding($last_char, $penultimate_char)
    {
        $vocative_ending = $this->gender == 1 ? $this->generateMaleEnding($last_char) : $this->generateFemaleEnding($last_char, $penultimate_char);

        return $vocative_ending;
    }

    public function generateMaleEnding($last_char)
    {
        switch ($last_char) {
            case in_array($last_char, self::LETTERS_CONSONANT):
            case 'я':
                $ending = 'е';
                break;

            case 'й':
                $ending = 'ю';
                break;

            case 'г':
                $ending = 'же';
                break;

            default:
                $ending = $last_char;
                break;
        }

        return $ending;
    }

    public function generateFemaleEnding($last_char, $penultimate_char)
    {
        if ($last_char == 'я')
            $ending = in_array($penultimate_char, self::LETTERS_CONSONANT) ? 'е' : 'є';
        else
            $ending = $last_char;


        return $ending;
    }

    /*
        Закінчення -е мають іменники чоловічого роду з твердим кінцевим приголосним та мішаної групи: Артеме, Альберте, Світе, Олеже, Ігоре, Гендельфе, Туре, Святославе, Авгуре, Аватаре, Вихоре
        Закінчення -е мають іменники жіночого роду на -я, якщо попередя літера приголосна: Зоре, Катрусе
        Закінчення -е мають іменники чоловічого роду на -я: Ілле
        Закінчення -є мають імена жіночого роду на -я, якщо попередя літера голосна: Лілеє, Соломіє, Софіє, Юліє
        Закінчення -о мають іменники чоловічого та жіночого роду на -а: Зірко, Оксано, Зоріно, Дзвінко, Ярославо
        Закінчення -ю мають чоловічі імена м'якої групи -й: Арію, Сергію, Андрію, Енею, Орію, Анатолію, Тарнаю
    */
}
