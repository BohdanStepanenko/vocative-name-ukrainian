<?php

/**
 * Convert name to vocative in ukrainian language
 * 
 * @author Bohdan Stepanenko
 * @version 1.0
 */

class Vocative
{
    protected const LETTERS_CONSONANT  = ['б', 'в', 'ґ', 'д', 'ж', 'з', 'к', 'л', 'м', 'н', 'п', 'р', 'с', 'т', 'ф', 'х', 'ц', 'ч', 'ш', 'щ'];
    protected const LETTERS_VOWEL = ['а', 'е', 'и', 'і', 'о', 'у', 'я', 'ю', 'є', 'ї'];

    protected int $gender;
    protected string $name;

    /**
     * @param integer $gender Gender (male = 1, female = 2)
     * @param string $name Name to convert
     * @return string $vocative Vocative name in ukrainian 
     */
    public function __construct($gender, $name)
    {
        $this->gender = $gender;
        $this->name = $name;
    }

    /**
     * Convert name to vocative
     *
     * @return string $vocative Vocative name in ukrainian 
     */
    public function convertToVocative()
    {
        $last_char = mb_substr($this->name, -1);
        $penultimate_char = mb_substr($this->name, -2);
        $vocative = self::getVocative($last_char, $penultimate_char);

        return $vocative;
    }

    /**
     * Get vocative ending by gender 
     * 
     * @param string $last_char Name last letter
     * @param string $penultimate_char Name penultimate letter
     * @return string $ending Vocative ending letter
     */
    public function getVocative($last_char, $penultimate_char)
    {
        $vocative_ending = $this->gender == 1 ? self::getMaleEnding($last_char) : self::getFemaleEnding($last_char, $penultimate_char);

        if (in_array($last_char, self::LETTERS_CONSONANT))
            $vocative = $this->name . $vocative_ending;
        else
            $vocative = substr_replace($this->name, $vocative_ending, -1);

        return $vocative;
    }

    /**
     * Generate vocative ending for male
     * 
     * @param string $last_char Name last letter
     * @return string $ending Vocative ending letter
     */
    public function getMaleEnding($last_char)
    {
        switch ($last_char) {
            case in_array($last_char, self::LETTERS_CONSONANT):
            case 'я':
                $ending = 'е';
                break;

            case 'а':
                $ending = 'о';
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
     * Generate vocative ending for female
     * 
     * @param string $last_char Name last letter
     * @param string $penultimate_char Name penultimate letter
     * @return string $ending Vocative ending letter
     */
    public function getFemaleEnding($last_char, $penultimate_char)
    {
        switch ($last_char) {
            case "а":
                $ending = 'о';
                break;

            case "я":
                $ending = in_array($penultimate_char, self::LETTERS_CONSONANT) ? 'е' : 'є';
                break;

            default:
                $ending = $last_char;
                break;
        }

        return $ending;
    }
}
