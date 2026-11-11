<?php

uses(Tests\TestCase::class);

test('request module is available to guests from the Services menu', function () {
    $this->get(route('request.index'))
        ->assertOk()
        ->assertSeeText('Request')
        ->assertSeeText('You can use this form without signing in')
        ->assertDontSeeText('My Requests')
        ->assertSeeText('Open Request Form')
        ->assertSeeText('Requester Information')
        ->assertSeeText('Type of Service')
        ->assertSeeText('Descriptive Analysis')
        ->assertSeeText('Explanatory Data Analysis')
        ->assertSeeText('Others, Specify')
        ->assertSeeText('Date Needed')
        ->assertSeeText('Submit Request')
        ->assertSeeText('Services')
        ->assertSeeText('PPAs')
        ->assertSee('href="'.route('request.index').'"', false)
        ->assertSee('href="'.route('reports.landing').'"', false);
});
