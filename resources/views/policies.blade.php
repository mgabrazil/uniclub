<x-layouts.app :title="__('Termos e Condições')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Termos e Condições') }}</flux:heading>
        <flux:separator variant="subtle" />
    </div>

    <section class="space-y-8">
        <h2 class="text-2xl font-semibold text-gray">1. Acúmulo de Pontos</h2>
        <ul class="list-inside list-disc space-y-2">
            <li>1.1. A cada R$10 em compras, o cliente acumula 1 ponto.</li>
            <li>1.2. No mês do aniversário, o cliente ganha 10 pontos extras.</li>
            <li>1.3. Indique um amigo: ao indicar um novo cliente, o participante recebe 5 pontos extras, desde que o indicado realize sua primeira compra.</li>
        </ul>
    </section>

    <section class="space-y-8">
        <h2 class="text-2xl font-semibold text-gray">2. Uso dos Pontos</h2>
        <ul class="list-inside list-disc space-y-2">
            <li>2.1. Cada ponto equivale a R$0,50 de desconto na próxima compra.</li>
            <li>2.2. O cliente pode utilizar até 30% do valor total da compra em descontos com os pontos acumulados.</li>
            <li>2.3. Os pontos não podem ser utilizados para compras de vale-troca.</li>
            <li>2.4. Os pontos não são cumulativos com outras promoções ou descontos, como pagamento via PIX.</li>
            <li>2.5. O saldo de pontos pode ser consultado no site da loja ou via atendimento ao cliente.</li>
        </ul>
    </section>

    <section class="space-y-8">
        <h2 class="text-2xl font-semibold text-gray">3. Validade e Cancelamento</h2>
        <ul class="list-inside list-disc space-y-2">
            <li>3.1. Os pontos acumulados têm validade de 45 dias a partir da data da compra.</li>
            <li>3.2. Em caso de troca ou devolução, os pontos referentes à compra serão automaticamente estornados.</li>
            <li>3.3. Caso o cliente cancele a compra, os pontos acumulados nessa transação serão removidos.</li>
            <li>3.4. Os pontos <strong>não podem</strong> ser trocados por dinheiro nem sacados.</li>
        </ul>
    </section>

    <section class="space-y-8">
        <h2 class="text-2xl font-semibold text-gray">4. Regras Gerais</h2>
        <ul class="list-inside list-disc space-y-2">
            <li>4.1. Os pontos são intransferíveis e só podem ser utilizados pelo titular, mediante apresentação de documento.</li>
            <li>4.2. O programa de pontos UniClub é um benefício exclusivo para clientes fidelizados.</li>
            <li>4.3. A Unipaper se reserva o direito de alterar as regras do programa a qualquer momento, mediante aviso prévio em seus canais oficiais.</li>
            <li>4.4. O uso indevido do programa, como fraudes ou tentativas de manipulação de pontos, pode resultar na exclusão do cliente do programa sem aviso prévio.</li>
        </ul>
    </section>

    <style>
.text-gray{
    color: #929292;
}
    </style>

</x-layouts.app>
