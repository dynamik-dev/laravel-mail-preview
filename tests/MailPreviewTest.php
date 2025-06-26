<?php

it('can render a mailable', function () {
    $response = $this->get(route('mail-preview.show', 'test-mailable'));

    $response->assertOk();
    $response->assertSee('Hello Batman');
});

test('can render a mailable with a custom slug', function () {
    $response = $this->get(route('mail-preview.show', 'test-mailable-with-custom-slug'));

    $response->assertOk();
    $response->assertSee('Hello Batman');
});

test('can use a custom route prefix', function () {

    $route = route('mail-preview.show', 'test-mailable-with-custom-slug');

    $this->assertEquals('http://localhost/custom-mail-preview/test-mailable-with-custom-slug', $route);

    $response = $this->get($route);

    $response->assertOk();
    $response->assertSee('Hello Batman');
});
