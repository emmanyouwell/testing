<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\UploadedFile;

class ItemExcelRule implements Rule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    private $file;

    public function __construct(UploadedFile $file)
    {
        $this->file = $file;
    }

    public function passes($attribute, $value)
    {
        $extension = strtolower($this->file->getClientOriginalExtension());

        return in_array($extension, ['csv', 'xls', 'xlsx']);
    }
    public function message()
    {
        return ' The excel file must be a file of type: xls, xlsx.';
    }
   
}