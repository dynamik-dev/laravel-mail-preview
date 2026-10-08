<?php

use Illuminate\Support\Facades\Route;

it('can render a list of mailables', function () {
    $response = $this->get(route('mail-preview.list'));

    $response->assertOk();
    $response->assertSee('test-mailable');
    $response->assertSee(route('mail-preview.show', ['slug' => 'test-mailable']), false);
});

it('uses the previewable title attribute on the listing page', function () {
    $response = $this->get(route('mail-preview.list'));

    $response->assertOk();
    $response->assertSee('Welcome to the Batcave');
    $response->assertDontSee('>test-titled-mailable<', false);
    $response->assertSee(route('mail-preview.show', ['slug' => 'test-titled-mailable']), false);
});

it('falls back to the slug when there is no previewable title attribute', function () {
    $response = $this->get(route('mail-preview.list'));

    $response->assertSee('>test-mailable<', false);
});

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

it('lists mailables marked with the previewable attribute', function () {
    $response = $this->get(route('mail-preview.list'));

    $response->assertOk();
    $response->assertSee('test-attribute-mailable');
    $response->assertDontSee('test-unmarked-mailable');
});

it('can render a mailable marked with the previewable attribute', function () {
    $response = $this->get(route('mail-preview.show', 'test-attribute-mailable'));

    $response->assertOk();
    $response->assertSee('Hello Robin');
});

it('does not render a mailable that is not marked as previewable', function () {
    $response = $this->get(route('mail-preview.show', 'test-unmarked-mailable'));

    $response->assertDontSee('Hello');
});

it('does not register routes when disabled', function () {
    $this->mailPreviewEnabled = false;
    $this->refreshApplication();

    expect(Route::has('mail-preview.list'))->toBeFalse()
        ->and(Route::has('mail-preview.show'))->toBeFalse();

    $this->get('/custom-mail-preview')->assertNotFound();
    $this->get('/custom-mail-preview/test-mailable')->assertNotFound();
});
