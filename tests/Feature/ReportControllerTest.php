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
        $response = $this->get('/report/index?fromDate=2024-01-01&toDate=2024-12-31');
        $response->assertStatus(200);
    }

    public function testIndexWithInvalidDateRange()
    {
        $response = $this->get('/report/index?fromDate=invalid-date&toDate=2024-12-31');
        $response->assertStatus(400);
    }

    // public function testShowWithValidProductCode()
    // {
    //     $product = Product::factory()->create();
    //     $response = $this->get("/report/show/{$product->code}");
    //     $response->assertStatus(200);
    // }

    public function testShowWithInvalidProductCode()
    {
        $response = $this->get('/report/show/9999');
        $response->assertStatus(500);
    }

    // public function testDetailWithValidUserIdAndProductCode()
    // {
    //     $user = User::factory()->create();
    //     $product = Product::factory()->create();
    //     $response = $this->get("/report/detail/{$user->id}/{$product->code}");
    //     $response->assertStatus(200);
    // }

    // public function testDetailWithInvalidUserId()
    // {
    //     $product = Product::factory()->create();
    //     $response = $this->get('/report/detail/9999/' . $product->code);
    //     $response->assertStatus(404);
    // }

    // public function testViewWithValidUserName()
    // {
    //     $user = User::factory()->create();
    //     $response = $this->get("/report/view/{$user->user_name}");
    //     $response->assertStatus(200);
    // }

    public function testViewWithInvalidUserName()
    {
        $response = $this->get('/report/view/nonexistent-user');
        $response->assertStatus(404);
    }
}
