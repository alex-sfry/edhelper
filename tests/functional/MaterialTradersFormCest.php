<?php

class MaterialTradersFormCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnRoute('material-traders/index');
    }

    public function openMaterialTradersPage(\FunctionalTester $I)
    {
        $I->see('Material traders', 'h1');
        $I->see('Ref. System', '#stations-form label');
        $I->see('Material Type', '#stations-form label');
        $I->see('Search', 'button[type="submit"]');
    }

    public function submitEmptyForm(\FunctionalTester $I)
    {
        $I->submitForm('#stations-form', []);
        $I->expectTo('see validations errors');
        $I->see('Material traders', 'h1');
        $I->see('Ref. System cannot be blank');
    }

    public function submitFormSuccessfully(\FunctionalTester $I)
    {
        $I->submitForm('#stations-form', [
            'MaterialTradersSearch[refSystem]' => 'Sol',
            'MaterialTradersSearch[material_type]' => 'Raw'
        ]);
        $I->seeElement('table.table', ['data-bs-theme' => "dark"]);
        $I->seeElement('table.table > thead > tr > th');
        $I->see('material type', 'table.table > thead > tr > th');
        $I->see('station', 'table.table > thead > tr > th');
        $I->see('distance to arrival (LS)', 'table.table > thead > tr > th');
        $I->see('system', 'table.table > thead > tr > th');
        $I->see('distance from ref (LY)', 'table.table > thead > tr > th');
        $I->see('raw', 'table.table > tbody > tr > td:first-child');
        $I->dontSee('encoded', 'table.table > tbody > tr > td:first-child');
        $I->dontSee('manufactured', 'table.table > tbody > tr > td:first-child');

        $I->submitForm('#stations-form', [
            'MaterialTradersSearch[refSystem]' => 'Sol',
            'MaterialTradersSearch[material_type]' => 'Encoded'
        ]);
        $I->see('encoded', 'table.table > tbody > tr > td:first-child');
        $I->dontSee('raw', 'table.table > tbody > tr > td:first-child');
        $I->dontSee('manufactured', 'table.table > tbody > tr > td:first-child');

        $I->submitForm('#stations-form', [
            'MaterialTradersSearch[refSystem]' => 'Sol',
            'MaterialTradersSearch[material_type]' => 'manufactured'
        ]);
        $I->see('manufactured', 'table.table > tbody > tr > td:first-child');
        $I->dontSee('raw', 'table.table > tbody > tr > td:first-child');
        $I->dontSee('encoded', 'table.table > tbody > tr > td:first-child');

        $I->submitForm('#stations-form', [
            'MaterialTradersSearch[refSystem]' => 'Sol',
            'MaterialTradersSearch[material_type]' => ''
        ]);
        $I->see('manufactured', 'table.table > tbody > tr > td:first-child');
        $I->see('raw', 'table.table > tbody > tr > td:first-child');
        $I->see('encoded', 'table.table > tbody > tr > td:first-child');

        $I->seeElement('ul.pagination');
        $I->see('1', 'ul.pagination > li');
    }

    public function submitFormResultNothingFound(\FunctionalTester $I)
    {
        $I->submitForm('#stations-form', [
            'MaterialTradersSearch[refSystem]' => 'Sol',
            'MaterialTradersSearch[material_type]' => 'qwerty'
        ]);
        $I->see('found nothing');
    }

    public function submitFormNonExistantRefSystem(\FunctionalTester $I)
    {
        $I->expectThrowable(InvalidArgumentException::class, function () use ($I) {
            $I->submitForm('#stations-form', [
                'MaterialTradersSearch[refSystem]' => 'qwerty',
                'MaterialTradersSearch[material_type]' => ''
            ]);
        });
    }
}
