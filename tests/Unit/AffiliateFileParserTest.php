<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Libs\AffiliateParser;

class AffiliateFileParserTest extends TestCase
{
    public function test_can_parse_txt_file(): void
    {
        $parser = AffiliateParser::parse('affiliates.txt');

        $this->assertNotNull($parser);
    }

    public function test_can_parse_json_file(): void
    {
        $parser = AffiliateParser::parse('affiliates.json');

        $this->assertNotNull($parser);
    }

    public function test_null_parser_when_parsing_empty_txt_file(): void
    {
        $parser = AffiliateParser::parse('affiliates-empty.txt');

        $this->assertNull($parser);
    }

    public function test_null_parser_when_parsing_empty_json_file(): void
    {
        $parser = AffiliateParser::parse('affiliates-empty.json');

        $this->assertNull($parser);
    }

    public function test_null_parser_when_parsing_file_other_than_txt_or_json(): void
    {
        $this->withExceptionHandling();

        $parser = AffiliateParser::parse('affiliates.jpg');

        $this->assertNull($parser);
    }

    public function test_loads_32_affiliates_into_array_from_txt_file(): void
    {
        $parser = AffiliateParser::parse('affiliates.txt');

        $affiliates = $parser->getAffiliates();

        $this->assertIsArray($affiliates);
        $this->assertCOunt(32, $affiliates);
    }

    public function test_loads_32_affiliates_into_array_from_json_file(): void
    {
        $parser = AffiliateParser::parse('affiliates.json');

        $affiliates = $parser->getAffiliates();

        $this->assertIsArray($affiliates);
        $this->assertCOunt(32, $affiliates);
    }

    public function test_returns_1_affiliate_within_10km_of_dublin_office(): void
    {
        $parser = AffiliateParser::parse('affiliates.txt');

        $affiliatesWithInDistance = $parser ? $parser->getAffiliatesWithInDistanceUsingKM(10) : [];
        
        $this->assertIsArray($affiliatesWithInDistance);
        $this->assertCOunt(1, $affiliatesWithInDistance);
    }

    public function test_returns_8_affiliates_within_50km_of_dublin_office(): void
    {
        $parser = AffiliateParser::parse('affiliates.txt');

        $affiliatesWithInDistance = $parser ? $parser->getAffiliatesWithInDistanceUsingKM(50) : [];

        $this->assertIsArray($affiliatesWithInDistance);
        $this->assertCOunt(8, $affiliatesWithInDistance);
    }

    public function test_returns_16_affiliates_within_100km_of_dublin_office(): void
    {
        $parser = AffiliateParser::parse('affiliates.txt');

        $affiliatesWithInDistance = $parser ? $parser->getAffiliatesWithInDistanceUsingKM(100) : [];

        $this->assertIsArray($affiliatesWithInDistance);
        $this->assertCOunt(16, $affiliatesWithInDistance);
    }

    public function test_returns_16_affiliates_outside_100km_of_dublin_office(): void
    {
        $parser = AffiliateParser::parse('affiliates.txt');

        $affiliatesOutsideDistance = $parser ? $parser->getAffiliatesOutsideDistanceUsingKM(100) : [];

        $this->assertIsArray($affiliatesOutsideDistance);
        $this->assertCOunt(16, $affiliatesOutsideDistance);
    }
}
