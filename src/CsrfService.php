<?php

namespace Pyramid;

use Random\RandomException;

class CsrfService {

	/**  Formda kullanılacak token'ı döndür
	 * @throws RandomException
	 */
	public static function csrfField(): string {
		// CSRF token'ı session'da var mı kontrol et
		if ( ! session_hash( 'csrf_token' ) || session_hash( 'csrf_token' ) ) {
			// Eğer yoksa, yeni bir token oluştur
			$rand = bin2hex( random_bytes( 32 ) );  // 32 byte'lık rastgele bir token
			session( 'csrf_token', $rand );  // Token'ı session'a kaydet
		}

		// Token'ı formda kullanmak üzere döndür
		return '<input type="hidden" name="csrf_token" value="' . session( 'csrf_token' ) . '">';
	}
}
