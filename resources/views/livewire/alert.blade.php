<div>
    @if(isset($name) && isset($email) && isset($amount))
        <div class="alert alert-success">
            <strong>Submitted Data:</strong><br>
            Name: {{ $name }}<br>
            Email: {{ $email }}<br>
            Amount: {{ $amount }}
        </div>
    @endif
    <div class="alert alert-success">
        <strong>Submitted Data:</strong><br>
        Name: {{ $name ?? "" }}<br>
        Email: {{ $email ?? "" }}<br>
        Amount: {{ $amount ?? "" }}
    </div>
</div>
