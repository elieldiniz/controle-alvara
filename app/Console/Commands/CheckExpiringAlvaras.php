<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CheckExpiringAlvaras extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-expiring-alvaras';

    protected $description = 'Verifica alvarás próximos ao vencimento e envia notificações aos usuários';

    public function handle()
    {
        $alvaras = \App\Models\Alvara::where('status', 'proximo')->get();

        $this->info("🔍 Analisando alvarás... Encontrados {$alvaras->count()} com vencimento próximo.");

        foreach ($alvaras as $alvara) {
            if ($alvara->user) {
                try {
                    $alvara->user->notify(new \App\Notifications\VencimentoAlvaraNotification($alvara));
                    $this->line("✅ Notificação disparada para {$alvara->user->email} (Alvará: {$alvara->tipo})");
                } catch (\Exception $e) {
                    $this->error("❌ Falha ao notificar {$alvara->user->email}: " . $e->getMessage());
                }
            } else {
                $this->warn("⚠️ O alvará ID {$alvara->id} ({$alvara->tipo}) não possui usuário vinculado.");
            }
        }

        $this->info('🚀 Processamento de notificações finalizado.');
    }
}
