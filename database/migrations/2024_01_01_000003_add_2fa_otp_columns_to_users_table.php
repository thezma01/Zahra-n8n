<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // For 2FA (TOTP)
            $table->text('two_factor_secret')
                  ->nullable()
                  ->after('password');

            $table->text('two_factor_recovery_codes')
                  ->nullable()
                  ->after('two_factor_secret');

            $table->timestamp('two_factor_enabled_at')
                  ->nullable()
                  ->after('two_factor_recovery_codes');

            // For OTP (Email/Phone verification)
            $table->string('otp_secret', 64) // For storing the hashed OTP code
                  ->nullable()
                  ->after('two_factor_enabled_at');

            $table->timestamp('otp_expires_at')
                  ->nullable()
                  ->after('otp_secret');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'two_factor_secret',
                'two_factor_recovery_codes',
                'two_factor_enabled_at',
                'otp_secret',
                'otp_expires_at',
            ]);
        });
    }
};

