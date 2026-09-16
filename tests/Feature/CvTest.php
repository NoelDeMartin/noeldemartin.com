<?php

test('CV HTML page', function () {
    $response = $this->get('/cv');

    $response->assertStatus(200);
    $response->assertSee('Noel De Martin');
    $response->assertSee('Fullstack Developer');
    $response->assertSee('Work History');
    $response->assertSee('Side Projects');
    $response->assertSee('Moodle');
    $response->assertSee('Education');
    $response->assertSee('Download PDF');
    $response->assertSee(url('cv.pdf'));
});
