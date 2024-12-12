<?php

namespace Pyramid;

use Pyramid\Request;

class CsrfMiddleware {
	public function handle( Request $request, \Closure $next ) {

		/** CSRF doğrulaması sadece POST, PUT, PATCH, DELETE istekleri için yapılır */
		if ( $_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'PUT' || $_SERVER['REQUEST_METHOD'] === 'PATCH' || $_SERVER['REQUEST_METHOD'] === 'DELETE' ) {

			/**  CSRF token'ı kontrol et */
			if ( empty( $_POST['csrf_token'] ) || $_POST['csrf_token'] !== session( 'csrf_token' ) ) {
				die( "Geçersiz CSRF token!" );  // Token geçersizse işlem durur
			}
		}

		/**  Doğrulama başarılıysa, isteğin işleme devam etmesine izin verilir */
		return $next( $request );
	}
}
