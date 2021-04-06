<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Rules\Isbn;
use Biblys\Isbn\Isbn as IsbnValidator;

class IsbnValidationTest extends TestCase
{
    /**
     * Validate ISBN library and validation rule.
     *
     * @return void
     */
    public function test_isbn_validation()
    {
        $isbn_values = ['978-2-843-44949-9', '99921-58-10-7', '80-902734-1-6', '1-4028-9462-7'];
        $rule = new Isbn;

        foreach ($isbn_values as $isbn)
        {
            $this->assertTrue(IsbnValidator::isParsable($isbn));
            $this->assertTrue($rule->passes('attribute', $isbn));
        }
        
        $this->assertFalse($rule->passes('attribute', 'some string'));

    }
}
