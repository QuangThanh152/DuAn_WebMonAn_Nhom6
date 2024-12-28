<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\CartModel;
use App\Models\OrderModel;
use App\Models\OrderListModel;

class CartController extends Controller {
    private $cartModel;
    private $orderModel;
    private $orderListModel;

    public function __construct() {
        $conn = new \mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $this->cartModel = new CartModel($conn);
        $this->orderModel = new OrderModel($conn);
        $this->orderListModel = new OrderListModel($conn);
    }

    public function addProductToCart($productId, $qty) {
        $user_info = $_SESSION['user'];

        if (!isset($user_info['user_id']) || !isset($user_info['username'])) {
            $_SESSION['notification'] = 'Thiếu thông tin người dùng. Vui lòng đăng nhập lại.';
            $this->redirect('/login');
            return;
        }

        $cartItem = $this->cartModel->getCartItemByUserIdAndProductId($user_info['user_id'], $productId);

        if ($cartItem) {
            $newQty = $cartItem['qty'] + $qty;
            $this->cartModel->updateCartItemQty($cartItem['id'], $newQty);
        } else {
            $this->cartModel->addCartItem($user_info['user_id'], $productId, $qty);
        }

        $this->viewCart();
    }

    public function removeProductFromCart($id) {
        $this->cartModel->deleteCartItem($id);
        $this->viewCart();
    }

    public function updateProductQtyInCart($id) {
        if (isset($_POST['qty'])) {
            $qty = $_POST['qty'];
            $this->cartModel->updateCartItemQty($id, $qty);
            $_SESSION['notification'] = 'Cập nhật thành công!';
            $this->redirect('/cart');
        } else {
            $this->redirect('/cart');
        }
    }

    public function checkout() {
        $user_info = $_SESSION['user'];

        if (!isset($user_info['user_id']) || !isset($user_info['username'])) {
            $_SESSION['notification'] = 'Thiếu thông tin người dùng. Vui lòng đăng nhập lại.';
            $this->redirect('/login');
            return;
        }

        $cart_items = $this->cartModel->getCartItems($user_info['user_id']);

        if (empty($cart_items)) {
            $_SESSION['notification'] = 'Giỏ hàng của bạn đang trống. Vui lòng thêm sản phẩm vào giỏ hàng trước khi thanh toán.';
            $this->redirect('/cart');
            return;
        }

        $name = $user_info['username'];
        $address = $user_info['address'];
        $mobile = $user_info['mobile'];
        $email = $user_info['email'];

        $order_id = $this->orderModel->addOrder($name, $address, $mobile, $email, 1);

        foreach ($cart_items as $item) {
            $this->orderListModel->addOrderItem($order_id, $item['product_id'], $item['qty']);
        }

        $this->cartModel->clearCart($user_info['user_id']);

        $_SESSION['notification'] = 'Thanh toán thành công!';
        $this->redirect('/cart');
    }

    public function viewCart() {
        $user_info = $_SESSION['user'];
        $cartItems = $this->cartModel->getCartItems($user_info['user_id']);
        $data = [
            'title' => 'Giỏ hàng của bạn',
            'cartItems' => $cartItems,
            'notification' => isset($_SESSION['notification']) ? $_SESSION['notification'] : null
        ];
        unset($_SESSION['notification']);
        $this->render('cart_list', $data);
    }
}
?>
