<?php

/**
 * Convert name to vocative form in ukrainian language
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

    /**
     * @param integer $gender Gender type (male = 1, female = 2)
     * @param string $name Name to convert
     */
    public function __construct($gender, $name)
    {
        $this->gender = $gender;
        $this->name = $name;
    }

    /**
     * Convert name to vocative form
     *
     * @return string $vocative
     */
    public function convertToVocative()
    {
        $last_char = substr($this->name, -1);

        if ($last_char == 'а') {
            $vocative_ending = str_replace('а', 'о', $last_char);
        } else {
            $penultimate_char = substr($this->name, -2);
            $vocative_ending = $this->getVocativeEnding($penultimate_char, $last_char);
        }

        $vocative = substr_replace($this->name, $vocative_ending, 1);

        return $vocative;
    }

    /**
     * Redirecting to vocative ending generator using gender
     * 
     * @param string $last_char Name last letter
     * @param string $penultimate_char Name penultimate letter
     * @return string $ending Vovel form ending letter
     */
    public function getVocativeEnding($last_char, $penultimate_char)
    {
        $vocative_ending = $this->gender == 1 ? $this->generateMaleEnding($last_char) : $this->generateFemaleEnding($last_char, $penultimate_char);

        return $vocative_ending;
    }

    /**
     * Generate vovel for male
     * 
     * @param string $last_char Name last letter
     * @return string $ending Vovel form ending letter
     */
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

    /**
     * Generate vovel for female
     * 
     * @param string $last_char Name last letter
     * @param string $penultimate_char Name penultimate letter
     * @return string $ending Vovel form ending letter
     */
    public function generateFemaleEnding($last_char, $penultimate_char)
    {
        if ($last_char == 'я')
            $ending = in_array($penultimate_char, self::LETTERS_CONSONANT) ? 'е' : 'є';
        else
            $ending = $last_char;

        return $ending;
    }
}
