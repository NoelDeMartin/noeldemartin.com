<?php

namespace Tests\Feature;

use Tests\TestCase;

class BlogTest extends TestCase {

    public function testBasic() {
        $response = $this->get('/blog');

        $response->assertStatus(200);
    }

}
