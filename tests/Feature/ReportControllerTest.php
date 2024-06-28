<?php
namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Report;
use App\Models\Admin\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReportControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndexWithValidDateRange()
    {
        $response = $this->get('/reports?fromDate=2024-01-01&toDate=2024-12-31');
        $response->assertStatus(200);
    }

    public function testIndexWithInvalidDateRange()
    {
        $response = $this->get('/reports?fromDate=invalid-date&toDate=2024-12-31');
        $response->assertStatus(400);
    }

    public function testShowWithValidProductCode()
    {
        $product = Product::factory()->create();
        $response = $this->get("/reports/{$product->code}");
        $response->assertStatus(200);
    }

    public function testShowWithInvalidProductCode()
    {
        $response = $this->get('/reports/9999');
        $response->assertStatus(500);
    }

    public function testDetailWithValidUserId()
    {
        $user = User::factory()->create();
        $response = $this->get("/reports/detail/{$user->id}");
        $response->assertStatus(200);
    }

    public function testDetailWithInvalidUserId()
    {
        $response = $this->get('/reports/detail/9999');
        $response->assertStatus(404);
    }

    public function testViewWithValidUserName()
    {
        $user = User::factory()->create();
        $response = $this->get("/reports/view/{$user->user_name}");
        $response->assertStatus(200);
    }

    public function testViewWithInvalidUserName()
    {
        $response = $this->get('/reports/view/nonexistent-user');
        $response->assertStatus(500);
    }
}
