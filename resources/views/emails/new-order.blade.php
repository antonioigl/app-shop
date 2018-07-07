@component('mail::message')

# Nuevo pedido

¡Se ha realizado un nuevo pedido!

@component('mail::panel')

Estos son los **datos del cliente** que realizó el pedido:

+ **Nombre:** {!! $user->name !!}
+ **E-mail:**  {{$user->email}}
+ **Fecha del pedido:**  {{$cart->order_date}}

@endcomponent

@component('mail::panel')

Y estos son los **detalles del pedido**:

@foreach ($cart->details as $detail)
+ {{$detail->product->name}} x {{$detail->quantity}} (&euro; {{$detail->quantity * $detail->price_detail}})
@endforeach

@endcomponent

**Importe que el cliente debe pagar:** {{$cart->total}}

@component('mail::button', [ 'url' => url('admin/orders/'.$cart->id) ])
Ver pedido
@endcomponent

 {{--Footer --}}
@slot('footer')
    @component('mail::footer')
        © {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.
    @endcomponent
@endslot
@endcomponent
