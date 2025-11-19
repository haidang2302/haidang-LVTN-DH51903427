<?php
 use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthenticateMiddleware; 
use App\Http\Controllers\Backend\User\AuthController; 
use App\Http\Controllers\Backend\DashboardController; 
use App\Http\Controllers\Ajax\DashboardController as AjaxDashboardController; 
use App\Http\Controllers\Backend\User\UserController; 
use App\Http\Controllers\Backend\User\UserCatalogueController; 
use App\Http\Controllers\Backend\User\PermissionController; 
use App\Http\Controllers\Backend\Customer\CustomerController; 
use App\Http\Controllers\Backend\Customer\CustomerCatalogueController; 



use App\Http\Controllers\Backend\LanguageController; 

use App\Http\Controllers\Backend\MenuController; 
 
use App\Http\Controllers\Backend\WidgetController; 
use App\Http\Controllers\Backend\ReportController; 
use App\Http\Controllers\Backend\OrderController; 
use App\Http\Controllers\Backend\Promotion\PromotionController; 

use App\Http\Controllers\Ajax\LocationController; 
use App\Http\Controllers\Ajax\AttributeController as AjaxAttributeController; 
use App\Http\Controllers\Ajax\MenuController as AjaxMenuController; 

use App\Http\Controllers\Ajax\ProductController as AjaxProductController; 

use App\Http\Controllers\Ajax\CartController as AjaxCartController; 
use App\Http\Controllers\Ajax\OrderController as AjaxOrderController; 

 

use App\Http\Controllers\Backend\Product\ProductCatalogueController; 
use App\Http\Controllers\Backend\Product\ProductController; 
use App\Http\Controllers\Backend\Attribute\AttributeCatalogueController; 
use App\Http\Controllers\Backend\Attribute\AttributeController; 

use App\Http\Controllers\Frontend\HomeController; 
use App\Http\Controllers\Frontend\RouterController; 
use App\Http\Controllers\Frontend\CartController; 
use App\Http\Controllers\Frontend\Payment\VnpayController; 
use App\Http\Controllers\Frontend\Payment\MomoController; 
use App\Http\Controllers\Frontend\Payment\PaypalController; 
use App\Http\Controllers\Frontend\CrawlerController; 
 
use App\Http\Controllers\Frontend\AuthController as FeAuthController; 
 
use App\Http\Controllers\Frontend\CustomerController as FeCustomerController; 


use App\Http\Controllers\Frontend\ProductCatalogueController as FeProductCatalogueController; 

use App\Http\Controllers\Backend\Crm\ConstructionController; 
use App\Http\Controllers\Ajax\ConstructController as AjaxConstructController; 
use App\Http\Controllers\Ajax\CustomerController as AjaxCustomerController; 
use App\Http\Controllers\Frontend\MyOrder\MyOrderController;

// Ưu tiên route thanh-toan lên đầu để tránh bị route động bắt mất
Route::get("thanh-toan" . config("apps.general.suffix"), [CartController::class, "checkout"])->name("cart.checkout");
Route::get('thanh-toan', [CartController::class, 'checkout'])->name('cart.checkout');

Route::get("crawlerUpdateProduct", array(CrawlerController::class, "updateProduct"))->name("crawler.product.update");
Route::get("logout", array(AuthController::class, "logout"))->name("auth.logout");
Route::get("customer/register" . config("apps.general.suffix"), array(FeAuthController::class, "register"))->name("customer.register");

Route::post("cart/create", array(CartController::class, "store"))->name("cart.store"); 
Route::get("customer/password/email" . config("apps.general.suffix"), array(FeAuthController::class, "verifyCustomerEmail"))->name("customer.password.email"); 
Route::get("ajax/location/getLocation", array(LocationController::class, "getLocation"))->name("ajax.location.index");

Route::post("ajax/product/wishlist", array(AjaxProductController::class, "wishlist"))->name("product.wishlist");
Route::group(array("middleware" => array("customer")), function () { 
Route::get("customer/profile" . config("apps.general.suffix"), array(FeCustomerController::class, "profile"))->name("customer.profile"); 
Route::post("customer/profile/update" . config("apps.general.suffix"), array(FeCustomerController::class, "updateProfile"))->name("customer.profile.update"); 
Route::get("customer/password/reset" . config("apps.general.suffix"), array(FeCustomerController::class, "passwordForgot"))->name("customer.password.change"); 
Route::post("customer/password/recovery" . config("apps.general.suffix"), array(FeCustomerController::class, "recovery"))->name("customer.password.recovery"); 
Route::get("customer/logout" . config("apps.general.suffix"), array(FeCustomerController::class, "logout"))->name("customer.logout"); 
Route::get("customer/construction" . config("apps.general.suffix"), array(FeCustomerController::class, "construction"))->name("customer.construction"); 
Route::get("customer/construction/{id}/product" . config("apps.general.suffix"), array(FeCustomerController::class, "constructionProduct"))->name("customer.construction.product")->where(array("id" => "[0-9]+"));
Route::get("customer/warranty/check" . config("apps.general.suffix"), array(FeCustomerController::class, "warranty"))->name("customer.check.warranty"); 
Route::post("customer/warranty/active", array(FeCustomerController::class, "active"))->name("customer.active.warranty"); 
}); 
Route::get("customer/check/login" . config("apps.general.suffix"), array(FeAuthController::class, "login"))->name("fe.auth.dologin");
Route::get("tim-kiem" . config("apps.general.suffix"), array(FeProductCatalogueController::class, "search"))->name("product.catalogue.search");
Route::get("paypal/success" . config("apps.general.suffix"), array(PaypalController::class, "success"))->name("paypal.success");
Route::get("ajax/product/filter", array(AjaxProductController::class, "filter"))->name("ajax.filter"); 

Route::get("ajax/product/loadVariant", array(AjaxProductController::class, "loadVariant"))->name("ajax.loadVariant");
Route::get("return/vnpay_ipn" . config("apps.general.suffix"), array(VnpayController::class, "vnpay_ipn"))->name("vnpay.vnpay_ipn");
Route::get("gio-hang" . config("apps.general.suffix"), array(CartController::class, "cart"))->name("cart.cart"); 

Route::get("paypal/cancel" . config("apps.general.suffix"), array(PaypalController::class, "cancel"))->name("paypal.cancel"); 
Route::get("{canonical}/trang-{page}" . config("apps.general.suffix"), array(RouterController::class, "page"))->name("router.page")->where("canonical", "[a-zA-Z0-9-]+")->where("page", "[0-9]+"); 
Route::post("customer/reg" . config("apps.general.suffix"), array(FeAuthController::class, "registerAccount"))->name("customer.reg");

Route::post("customer/password/change" . config("apps.general.suffix"), array(FeAuthController::class, "changePassword"))->name("customer.password.reset");

Route::post("updatePermission", array(CustomerCatalogueController::class, "updatePermission"))->name("customer.catalogue.updatePermission");
Route::get("return/momo" . config("apps.general.suffix"), array(MomoController::class, "momo_return"))->name("momo.momo_return");
Route::get("customer/password/update" . config("apps.general.suffix"), array(FeAuthController::class, "updatePassword"))->name("customer.update.password");
Route::get("/don-hang-cua-toi", array(MyOrderController::class, "index"))->name("my-order.index");
Route::get("cart/{code}/success" . config("apps.general.suffix"), array(CartController::class, "success"))->name("cart.success")->where(array("code" => "[0-9]+"));
Route::get("crawler", array(CrawlerController::class, "index"))->name("crawler.ckfinder");
Route::get("customer/password/forgot" . config("apps.general.suffix"), array(FeAuthController::class, "forgotCustomerPassword"))->name("forgot.customer.password");
Route::get("crawlerUpdate", array(CrawlerController::class, "crawlerUpdate"))->name("crawler.update");

Route::get("admin", array(AuthController::class, "index"))->name("auth.admin")->middleware("login");
Route::get("{canonical}" . config("apps.general.suffix"), array(RouterController::class, "index"))->name("router.index")->where("canonical", "[a-zA-Z0-9-]+");

Route::get("thanh-toan" . config("apps.general.suffix"), array(CartController::class, "checkout"))->name("cart.checkout");
Route::post("ajax/cart/delete", array(AjaxCartController::class, "delete"))->name("ajax.cart.delete");
Route::get("crawlerProduct", array(CrawlerController::class, "crawlerProduct"))->name("crawler.product");
Route::get("return/vnpay" . config("apps.general.suffix"), array(VnpayController::class, "vnpay_return"))->name("vnpay.momo_return");

Route::get("customer/login" . config("apps.general.suffix"), array(FeAuthController::class, "index"))->name("fe.auth.login");
Route::post("ajax/cart/create", array(AjaxCartController::class, "create"))->name("ajax.cart.create");
Route::post("ajax/cart/update", array(AjaxCartController::class, "update"))->name("ajax.cart.update");
Route::get("return/ipn" . config("apps.general.suffix"), array(MomoController::class, "vnpay_ipn"))->name("momo.momo_ipn");
Route::get("danh-sach-yeu-thich" . config("apps.general.suffix"), array(FeProductCatalogueController::class, "wishlist"))->name("product.catalogue.wishlist");
Route::group(array("middleware" => array("admin", "locale", "backend_default_locale")), function () { 
    Route::get("dashboard/index", array(DashboardController::class, "index"))->name("dashboard.index");
}); 
    Route::group(array("prefix" => "user"), function () { 
        Route::get("index", array(UserController::class, "index"))->name("user.index"); 
        Route::get("create", array(UserController::class, "create"))->name("user.create"); 
        Route::post("store", array(UserController::class, "store"))->name("user.store"); 
        Route::get("{id}/edit", array(UserController::class, "edit"))->where(array("id" => "[0-9]+"))->name("user.edit"); 
        Route::post("{id}/update", array(UserController::class, "update"))->where(array("id" => "[0-9]+"))->name("user.update"); 
        Route::get("{id}/delete", array(UserController::class, "delete"))->where(array("id" => "[0-9]+"))->name("user.delete"); 
        Route::delete("{id}/destroy", array(UserController::class, "destroy"))->where(array("id" => "[0-9]+"))->name("user.destroy"); 
    }); 
        Route::group(array("prefix" => "user/catalogue"), function () { 
            Route::get("index", array(UserCatalogueController::class, "index"))->name("user.catalogue.index"); 
            Route::get("create", array(UserCatalogueController::class, "create"))->name("user.catalogue.create"); 
            Route::post("store", array(UserCatalogueController::class, "store"))->name("user.catalogue.store"); 
            Route::get("{id}/edit", array(UserCatalogueController::class, "edit"))->where(array("id" => "[0-9]+"))->name("user.catalogue.edit");
            Route::post("{id}/update", array(UserCatalogueController::class, "update"))->where(array("id" => "[0-9]+"))->name("user.catalogue.update"); 
            Route::get("{id}/delete", array(UserCatalogueController::class, "delete"))->where(array("id" => "[0-9]+"))->name("user.catalogue.delete"); 
            Route::delete("{id}/destroy", array(UserCatalogueController::class, "destroy"))->where(array("id" => "[0-9]+"))->name("user.catalogue.destroy"); 
            Route::get("permission", array(UserCatalogueController::class, "permission"))->name("user.catalogue.permission"); 
            Route::post("updatePermission", array(UserCatalogueController::class, "updatePermission"))->name("user.catalogue.updatePermission"); 
        }); 
            Route::group(array("prefix" => "customer"), function () { 
                Route::get("index", array(CustomerController::class, "index"))->name("customer.index"); 
                Route::get("create", array(CustomerController::class, "create"))->name("customer.create"); 
                Route::post("store", array(CustomerController::class, "store"))->name("customer.store"); 
                Route::get("{id}/edit", array(CustomerController::class, "edit"))->where(array("id" => "[0-9]+"))->name("customer.edit"); 
                Route::post("{id}/update", array(CustomerController::class, "update"))->where(array("id" => "[0-9]+"))->name("customer.update"); 
                Route::get("{id}/delete", array(CustomerController::class, "delete"))->where(array("id" => "[0-9]+"))->name("customer.delete"); 
                Route::delete("{id}/destroy", array(CustomerController::class, "destroy"))->where(array("id" => "[0-9]+"))->name("customer.destroy"); 
            }); 
                Route::group(array("prefix" => "customer/catalogue"), function () { 
                    Route::get("index", array(CustomerCatalogueController::class, "index"))->name("customer.catalogue.index"); 
                    Route::get("create", array(CustomerCatalogueController::class, "create"))->name("customer.catalogue.create"); 
                    Route::post("store", array(CustomerCatalogueController::class, "store"))->name("customer.catalogue.store"); 
                    Route::get("{id}/edit", array(CustomerCatalogueController::class, "edit"))->where(array("id" => "[0-9]+"))->name("customer.catalogue.edit"); 
                    Route::post("{id}/update", array(CustomerCatalogueController::class, "update"))->where(array("id" => "[0-9]+"))->name("customer.catalogue.update"); 
                    Route::get("{id}/delete", array(CustomerCatalogueController::class, "delete"))->where(array("id" => "[0-9]+"))->name("customer.catalogue.delete"); 
                    Route::delete("{id}/destroy", array(CustomerCatalogueController::class, "destroy"))->where(array("id" => "[0-9]+"))->name("customer.catalogue.destroy"); 
                    Route::get("permission", array(CustomerCatalogueController::class, "permission"))->name("customer.catalogue.permission"); 
                    Route::post("updatePermission", array(CustomerCatalogueController::class, "updatePermission"))->name("customer.catalogue.updatePermission");
                 }); 
                 Route::group(array("prefix" => "language"), function () { 
                    Route::get("index", array(LanguageController::class, "index"))->name("language.index")->middleware(array("admin", "locale")); 
                    Route::get("create", array(LanguageController::class, "create"))->name("language.create"); 
                    Route::post("store", array(LanguageController::class, "store"))->name("language.store"); 
                    Route::get("{id}/edit", array(LanguageController::class, "edit"))->where(array("id" => "[0-9]+"))->name("language.edit"); 
                    Route::post("{id}/update", array(LanguageController::class, "update"))->where(array("id" => "[0-9]+"))->name("language.update"); 
                    Route::get("{id}/delete", array(LanguageController::class, "delete"))->where(array("id" => "[0-9]+"))->name("language.delete"); 
                    Route::delete("{id}/destroy", array(LanguageController::class, "destroy"))->where(array("id" => "[0-9]+"))->name("language.destroy"); 
                    Route::get("{id}/switch", array(LanguageController::class, "swicthBackendLanguage"))->where(array("id" => "[0-9]+"))->name("language.switch"); 
                    Route::get("{id}/{languageId}/{model}/translate", array(LanguageController::class, "translate"))->where(array("id" => "[0-9]+", "languageId" => "[0-9]+"))->name("language.translate"); 
                    Route::post("storeTranslate", array(LanguageController::class, "storeTranslate"))->name("language.storeTranslate"); 
                });
                    
                        Route::group(array("prefix" => "system"), function () { 
                            Route::get("index", array(SystemController::class, "index"))->name("system.index"); 
                            Route::post("store", array(SystemController::class, "store"))->name("system.store"); 
                            Route::get("{languageId}/translate", array(SystemController::class, "translate"))->where(array("languageId" => "[0-9]+"))->name("system.translate"); 
                            Route::post("{languageId}/saveTranslate", array(SystemController::class, "saveTranslate"))->where(array("languageId" => "[0-9]+"))->name("system.save.translate");
                         }); 
                            
                                Route::group(array("prefix" => "menu"), function () { 
                                    Route::get("index", array(MenuController::class, "index"))->name("menu.index"); 
                                    Route::get("create", array(MenuController::class, "create"))->name("menu.create"); 
                                    Route::post("store", array(MenuController::class, "store"))->name("menu.store"); 
                                    Route::get("{id}/edit", array(MenuController::class, "edit"))->where(array("id" => "[0-9]+"))->name("menu.edit"); 
                                    Route::get("{id}/editMenu", array(MenuController::class, "editMenu"))->where(array("id" => "[0-9]+"))->name("menu.editMenu"); 
                                    Route::post("{id}/update", array(MenuController::class, "update"))->where(array("id" => "[0-9]+"))->name("menu.update"); 
                                    Route::get("{id}/delete", array(MenuController::class, "delete"))->where(array("id" => "[0-9]+"))->name("menu.delete"); 
                                    Route::delete("{id}/destroy", array(MenuController::class, "destroy"))->where(array("id" => "[0-9]+"))->name("menu.destroy");
                                    Route::get("{id}/children", array(MenuController::class, "children"))->where(array("id" => "[0-9]+"))->name("menu.children"); 
Route::post("{id}/saveChildren", array(MenuController::class, "saveChildren"))->where(array("id" => "[0-9]+"))->name("menu.save.children"); 
Route::get("{languageId}/{id}/translate", array(MenuController::class, "translate"))->where(array("languageId" => "[0-9]+", "id" => "[0-9]+"))->name("menu.translate"); 
Route::post("{languageId}/saveTranslate", array(MenuController::class, "saveTranslate"))->where(array("languageId" => "[0-9]+"))->name("menu.translate.save");
 }); 

    
        Route::group(array("prefix" => "permission"), function () { 
            Route::get("index", array(PermissionController::class, "index"))->name("permission.index"); 
            Route::get("create", array(PermissionController::class, "create"))->name("permission.create"); 
            Route::post("store", array(PermissionController::class, "store"))->name("permission.store"); 
            Route::get("{id}/edit", array(PermissionController::class, "edit"))->where(array("id" => "[0-9]+"))->name("permission.edit"); 
            Route::post("{id}/update", array(PermissionController::class, "update"))->where(array("id" => "[0-9]+"))->name("permission.update"); 
            Route::get("{id}/delete", array(PermissionController::class, "delete"))->where(array("id" => "[0-9]+"))->name("permission.delete"); 
            Route::delete("{id}/destroy", array(PermissionController::class, "destroy"))->where(array("id" => "[0-9]+"))->name("permission.destroy");
         }); 
             
                Route::group(array("prefix" => "widget"), function () { 
                    Route::get("index", array(WidgetController::class, "index"))->name("widget.index"); 
                    Route::get("create", array(WidgetController::class, "create"))->name("widget.create"); 
                    Route::post("store", array(WidgetController::class, "store"))->name("widget.store"); 
                    Route::get("{id}/edit", array(WidgetController::class, "edit"))->where(array("id" => "[0-9]+"))->name("widget.edit"); 
                    Route::post("{id}/update", array(WidgetController::class, "update"))->where(array("id" => "[0-9]+"))->name("widget.update"); 
                    Route::get("{id}/delete", array(WidgetController::class, "delete"))->where(array("id" => "[0-9]+"))->name("widget.delete"); 
                    Route::delete("{id}/destroy", array(WidgetController::class, "destroy"))->where(array("id" => "[0-9]+"))->name("widget.destroy"); 
                    Route::get("{languageId}/{id}/translate", array(WidgetController::class, "translate"))->where(array("id" => "[0-9]+", "languageId" => "[0-9]+"))->name("widget.translate"); 
                    Route::post("saveTranslate", array(WidgetController::class, "saveTranslate"))->name("widget.saveTranslate");
                 }); 
                    
                        
                        Route::group(array("prefix" => "promotion"), function () { 
                            Route::get("index", array(PromotionController::class, "index"))->name("promotion.index"); 
                            Route::get("create", array(PromotionController::class, "create"))->name("promotion.create"); 
                            Route::post("store", array(PromotionController::class, "store"))->name("promotion.store"); 
                            Route::get("{id}/edit", array(PromotionController::class, "edit"))->where(array("id" => "[0-9]+"))->name("promotion.edit"); 
                            Route::post("{id}/update", array(PromotionController::class, "update"))->where(array("id" => "[0-9]+"))->name("promotion.update"); 
                            Route::get("{id}/delete", array(PromotionController::class, "delete"))->where(array("id" => "[0-9]+"))->name("promotion.delete"); 
                            Route::delete("{id}/destroy", array(PromotionController::class, "destroy"))->where(array("id" => "[0-9]+"))->name("promotion.destroy"); 
                        });        
                            Route::group(array("prefix" => "product/catalogue"), function () { 
                                Route::get("index", array(ProductCatalogueController::class, "index"))->name("product.catalogue.index"); 
                                Route::get("create", array(ProductCatalogueController::class, "create"))->name("product.catalogue.create"); 
                                Route::post("store", array(ProductCatalogueController::class, "store"))->name("product.catalogue.store"); 
                                Route::get("{id}/edit", array(ProductCatalogueController::class, "edit"))->where(array("id" => "[0-9]+"))->name("product.catalogue.edit"); 
                                Route::post("{id}/update", array(ProductCatalogueController::class, "update"))->where(array("id" => "[0-9]+"))->name("product.catalogue.update"); 
                                Route::get("{id}/delete", array(ProductCatalogueController::class, "delete"))->where(array("id" => "[0-9]+"))->name("product.catalogue.delete"); 
                                Route::delete("{id}/destroy", array(ProductCatalogueController::class, "destroy"))->where(array("id" => "[0-9]+"))->name("product.catalogue.destroy"); 
                            }); 
                                Route::group(array("prefix" => "product"), function () { 
                                    Route::get("index", array(ProductController::class, "index"))->name("product.index"); 
                                    Route::get("create", array(ProductController::class, "create"))->name("product.create"); 
                                    Route::post("store", array(ProductController::class, "store"))->name("product.store"); 
                                    Route::get("{id}/edit", array(ProductController::class, "edit"))->where(array("id" => "[0-9]+"))->name("product.edit"); 
                                    Route::post("{id}/update", array(ProductController::class, "update"))->where(array("id" => "[0-9]+"))->name("product.update"); 
                                    Route::get("{id}/delete", array(ProductController::class, "delete"))->where(array("id" => "[0-9]+"))->name("product.delete"); 
                                    Route::delete("{id}/destroy", array(ProductController::class, "destroy"))->where(array("id" => "[0-9]+"))->name("product.destroy"); 
                                     
});

// Di chuyển group attribute/catalogue ra ngoài để truy cập trực tiếp
Route::group(array("prefix" => "attribute/catalogue"), function () {
    Route::get("index", array(AttributeCatalogueController::class, "index"))->name("attribute.catalogue.index");
    Route::get("create", array(AttributeCatalogueController::class, "create"))->name("attribute.catalogue.create");
    Route::post("store", array(AttributeCatalogueController::class, "store"))->name("attribute.catalogue.store");
    Route::get("{id}/edit", array(AttributeCatalogueController::class, "edit"))->where(array("id" => "[0-9]+"))->name("attribute.catalogue.edit");
    Route::post("{id}/update", array(AttributeCatalogueController::class, "update"))->where(array("id" => "[0-9]+"))->name("attribute.catalogue.update");
    Route::get("{id}/delete", array(AttributeCatalogueController::class, "delete"))->where(array("id" => "[0-9]+"))->name("attribute.catalogue.delete");
    Route::delete("{id}/destroy", array(AttributeCatalogueController::class, "destroy"))->where(array("id" => "[0-9]+"))->name("attribute.catalogue.destroy");
});
Route::group(array("prefix" => "attribute"), function () { 
    Route::get("index", array(AttributeController::class, "index"))->name("attribute.index"); 
    Route::get("create", array(AttributeController::class, "create"))->name("attribute.create"); 
    Route::post("store", array(AttributeController::class, "store"))->name("attribute.store");
    Route::get("{id}/edit", array(AttributeController::class, "edit"))->where(array("id" => "[0-9]+"))->name("attribute.edit"); 
    Route::post("{id}/update", array(AttributeController::class, "update"))->where(array("id" => "[0-9]+"))->name("attribute.update"); 
    Route::get("{id}/delete", array(AttributeController::class, "delete"))->where(array("id" => "[0-9]+"))->name("attribute.delete"); 
    Route::delete("{id}/destroy", array(AttributeController::class, "destroy"))->where(array("id" => "[0-9]+"))->name("attribute.destroy"); 
}); 
    Route::group(array("prefix" => "order"), function () { 
        Route::get("index", array(OrderController::class, "index"))->name("order.index"); 
        Route::get("{id}/detail", array(OrderController::class, "detail"))->where(array("id" => "[0-9]+"))->name("order.detail"); 
    }); 
         
            Route::group(array("prefix" => "construction"), function () { 
                Route::get("index", array(ConstructionController::class, "index"))->name("construction.index"); 
                Route::get("create", array(ConstructionController::class, "create"))->name("construction.create"); 
                Route::post("store", array(ConstructionController::class, "store"))->name("construction.store"); 
                Route::get("{id}/edit", array(ConstructionController::class, "edit"))->where(array("id" => "[0-9]+"))->name("construction.edit"); 
                Route::post("{id}/update", array(ConstructionController::class, "update"))->where(array("id" => "[0-9]+"))->name("construction.update"); 
                Route::get("{id}/delete", array(ConstructionController::class, "delete"))->where(array("id" => "[0-9]+"))->name("construction.delete"); 
                Route::delete("{id}/destroy", array(ConstructionController::class, "destroy"))->where(array("id" => "[0-9]+"))->name("construction.destroy"); 
                Route::get("warranty", array(ConstructionController::class, "warranty"))->name("construction.warranty");
             }); 
                Route::group(array("prefix" => "report"), function () { 
                    Route::get("time", array(ReportController::class, "time"))->name("report.time"); 
                    Route::get("product", array(ReportController::class, "product"))->name("report.product"); 
                    Route::get("customer", array(ReportController::class, "customer"))->name("report.customer"); 
                }); 
                    Route::post("ajax/dashboard/changeStatus", array(AjaxDashboardController::class, "changeStatus"))->name("ajax.dashboard.changeStatus"); 
                    Route::post("ajax/dashboard/changeStatusAll", array(AjaxDashboardController::class, "changeStatusAll"))->name("ajax.dashboard.changeStatusAll"); 
                    Route::get("ajax/dashboard/getMenu", array(AjaxDashboardController::class, "getMenu"))->name("ajax.dashboard.getMenu"); 
                    Route::get("ajax/dashboard/findPromotionObject", array(AjaxDashboardController::class, "findPromotionObject"))->name("ajax.dashboard.findPromotionObject"); 
                    Route::get("ajax/dashboard/getPromotionConditionValue", array(AjaxDashboardController::class, "getPromotionConditionValue"))->name("ajax.dashboard.getPromotionConditionValue"); 
                    Route::get("ajax/attribute/getAttribute", array(AjaxAttributeController::class, "getAttribute"))->name("ajax.attribute.getAttribute"); 
                    Route::get("ajax/attribute/loadAttribute", array(AjaxAttributeController::class, "loadAttribute"))->name("ajax.attribute.getAttribute"); 
                    Route::post("ajax/menu/createCatalogue", array(AjaxMenuController::class, "createCatalogue"))->name("ajax.menu.createCatalogue"); 
                    Route::post("ajax/menu/drag", array(AjaxMenuController::class, "drag"))->name("ajax.menu.drag"); 
                    Route::post("ajax/menu/deleteMenu", array(AjaxMenuController::class, "deleteMenu"))->name("ajax.menu.deleteMenu"); 
                    
                    Route::get("ajax/product/loadProductPromotion", array(AjaxProductController::class, "loadProductPromotion"))->name("ajax.loadProductPromotion"); 
                     
                    Route::post("ajax/order/update", array(AjaxOrderController::class, "update"))->name("ajax.order.update"); 
                    Route::get("ajax/order/chart", array(AjaxOrderController::class, "chart"))->name("ajax.order.chart"); 
                    Route::post("ajax/construct/createAgency", array(AjaxConstructController::class, "createAgency"))->name("ajax.construct.createAgency"); 
                    Route::post("ajax/construct/createCustomer", array(AjaxCustomerController::class, "createCustomer"))->name("ajax.construct.createCustomer"); 
                    Route::post("ajax/product/deleteProduct", array(AjaxConstructController::class, "deleteProduct"))->name("ajax.product.deleteProduct"); 
                    Route::get("ajax/dashboard/findInformationObject", array(AjaxDashboardController::class, "findInformationObject"))->name("ajax.findInformationObject"); 
                 
                        Route::get("/don-hang-cua-toi/c", array(MyOrderController::class, "detail"))->name("my-order.detail"); 
                        Route::get("/", array(HomeController::class, "index"))->name("home.index"); 
                        Route::get("ajax/dashboard/findModelObject", array(AjaxDashboardController::class, "findModelObject"))->name("ajax.dashboard.findModelObject");
                        Route::post("login", array(AuthController::class, "login"))->name("auth.login");
        
// Routes cho thông báo yêu cầu đăng nhập truy cập giỏ hàng
Route::get('/cart/require-login', [App\Http\Controllers\Frontend\CartGuestController::class, 'requireLogin'])->name('cart.require.login');
Route::get('/cart/require-login', [App\Http\Controllers\Frontend\CartGuestController::class, 'requireLogin'])->name('cart.require.login');
Route::get('/cart/require-login-checkout', [App\Http\Controllers\Frontend\CartGuestController::class, 'requireLoginCheckout'])->name('cart.require.login.checkout');

// Test route đơn giản
Route::get('/test-checkout-message', function() {
    return view('frontend.auth.require-login-checkout');
});

// Routes với middleware customer cho AJAX cart
Route::middleware(['customer'])->group(function () {
    Route::post('/ajax/cart/create', [App\Http\Controllers\Ajax\CartController::class, 'create'])->name('ajax.cart.create.auth');
    Route::post('/ajax/cart/update', [App\Http\Controllers\Ajax\CartController::class, 'update'])->name('ajax.cart.update.auth');
    Route::post('/ajax/cart/delete', [App\Http\Controllers\Ajax\CartController::class, 'delete'])->name('ajax.cart.delete.auth');
});

// Routes cho đơn hàng của khách hàng - yêu cầu đăng nhập
Route::middleware(['customer'])->group(function () {
    Route::get('/don-hang-cua-toi', [App\Http\Controllers\Frontend\MyOrder\MyOrderController::class, 'index'])->name('my-order.index');
    Route::get('/don-hang-cua-toi/chi-tiet', [App\Http\Controllers\Frontend\MyOrder\MyOrderController::class, 'detail'])->name('my-order.detail');
});




