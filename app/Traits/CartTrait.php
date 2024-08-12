<?php

namespace App\Traits;

use App\Models\Product;
use Illuminate\Support\Facades\Cookie;

trait CartTrait
{
    /**
     * Add an item to the cart.
     *
     * @param  int  $productId
     * @return int
     */
    public static function addItemToCart(int $productId, int $qty = 1): int
    {
        $cartItems = self::getCartItemsFromCookie();
        $existingItemKey = self::findCartItemKey($cartItems, $productId);

        if ($existingItemKey !== null) {
            $cartItems[$existingItemKey]['quantity'] += $qty;
            $cartItems[$existingItemKey]['total_amount'] = $cartItems[$existingItemKey]['quantity'] * $cartItems[$existingItemKey]['price'];
        } else {
            $product = Product::find($productId, ['id', 'name', 'price', 'images']);

            if ($product) {
                $cartItems[] = [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'image' => $product->images[0],
                    'quantity' => $qty,
                    'price' => $product->price,
                    'total_amount' => $product->price,
                ];
            }
        }

        self::addCartItemsToCookie($cartItems);

        return count($cartItems);
    }

    /**
     * Remove an item from the cart.
     *
     * @param  int  $productId
     * @return array
     */
    public static function removeCartItems(int $productId): array
    {
        $cartItems = self::getCartItemsFromCookie();
        $existingItemKey = self::findCartItemKey($cartItems, $productId);

        if ($existingItemKey !== null) {
            unset($cartItems[$existingItemKey]);
        }

        self::addCartItemsToCookie($cartItems);

        return $cartItems;
    }

    /**
     * Add cart items to cookie.
     *
     * @param  array  $cartItems
     * @return void
     */
    public static function addCartItemsToCookie(array $cartItems): void
    {
        Cookie::queue('cart_items', json_encode($cartItems), 60 * 24 * 30);
    }

    /**
     * Clear cart items from cookie.
     *
     * @return void
     */
    public static function clearCartItems(): void
    {
        Cookie::queue(Cookie::forget('cart_items'));
    }

    /**
     * Get all cart items from cookie.
     *
     * @return array
     */
    public static function getCartItemsFromCookie(): array
    {
        return json_decode(Cookie::get('cart_items', '[]'), true);
    }

    /**
     * Increment the quantity of a cart item.
     *
     * @param  int  $productId
     * @return array
     */
    public static function incrementQuantityToCartItem(int $productId): array
    {
        $cartItems = self::getCartItemsFromCookie();
        $existingItemKey = self::findCartItemKey($cartItems, $productId);

        if ($existingItemKey !== null) {
            $cartItems[$existingItemKey]['quantity']++;
            $cartItems[$existingItemKey]['total_amount'] = $cartItems[$existingItemKey]['quantity'] * $cartItems[$existingItemKey]['price'];
        }

        self::addCartItemsToCookie($cartItems);

        return $cartItems;
    }

    /**
     * Decrement the quantity of a cart item.
     *
     * @param  int  $productId
     * @return array
     */
    public static function decrementQuantityToCartItem(int $productId): array
    {
        $cartItems = self::getCartItemsFromCookie();
        $existingItemKey = self::findCartItemKey($cartItems, $productId);

        if ($existingItemKey !== null && $cartItems[$existingItemKey]['quantity'] > 1) {
            $cartItems[$existingItemKey]['quantity']--;
            $cartItems[$existingItemKey]['total_amount'] = $cartItems[$existingItemKey]['quantity'] * $cartItems[$existingItemKey]['price'];
        }

        self::addCartItemsToCookie($cartItems);

        return $cartItems;
    }

    /**
     * Calculate the grand total of the cart.
     *
     * @param  array  $items
     * @return float
     */
    public static function calculateGrandTotal(array $items): float
    {
        return array_sum(array_column($items, 'total_amount'));
    }

    /**
     * Find the key of a cart item in the array.
     *
     * @param  array  $cartItems
     * @param  int  $productId
     * @return int|null
     */
    public static function findCartItemKey(array $cartItems, int $productId): ?int
    {
        foreach ($cartItems as $key => $item) {
            if ($item['product_id'] === $productId) {
                return $key;
            }
        }

        return null;
    }
}
