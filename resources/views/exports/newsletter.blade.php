<table>
	<tr>
		<td>Nome</td>
		<td>Email</td>
		<td>Whatsapp</td>
		<td>Profissão</td>
	</tr>
	@foreach( $newsletter as $contact )
		<tr>
			<td>{{$contact->name}}</td>
			<td>{{$contact->email}}</td>
			<td>{{$contact->whatsapp}}</td>
			<td>{{$contact->profession}}</td>
		</tr>
	@endforeach
</table>