<?php

namespace Happypixels\Shopr\Tests\Unit\Rules\Discounts;

use Happypixels\Shopr\Rules\Discounts\OnlyOneCouponPerOrder;
use Happypixels\Shopr\Tests\Support\Traits\InteractsWithCart;
use Happypixels\Shopr\Tests\TestCase;

class OnlyOneCouponPerOrderRuleTest extends TestCase
{
    use InteractsWithCart;

    /** @test */
    public function it_fails_if_any_coupon_has_been_applied()
    {
        $this->mockCart()->shouldReceive('hasDiscount')->with()->andReturn(true);

        $this->assertFalse((new OnlyOneCouponPerOrder)->passes('code', 'TEST'));
    }

    /** @test */
    public function it_passes_if_no_coupon_has_been_applied()
    {
        $this->mockCart()->shouldReceive('hasDiscount')->with()->andReturn(false);

        $this->assertTrue((new OnlyOneCouponPerOrder)->passes('code', 'TEST'));
    }
}
