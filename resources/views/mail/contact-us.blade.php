<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<span><b>Hello Admin,</b></span>  
	<div style=""> 
		<table>
			<tbody> 
				<tr>
					<td width="50%">Name:</td>
					<td width="50%">{{ $contactUs['name'] }}</td>
				</tr>
				<tr>
					<td width="50%">Email Id:</td>
					<td width="50%">{{ $contactUs['email_id'] }}</td>
				</tr>
				<tr>
					<td width="50%">Subject:</td>
					<td width="50%">{{ $contactUs['subject'] }}</td>
				</tr>
				<tr>
					<td width="50%">Message:</td>
					<td width="50%">{{ $contactUs['message'] }}</td>
				</tr> 
			</tbody>
		</table>   
	</div> 
	<div style="padding-top:15px;"> 
	<p>
		<b>Thank You</b>,</br>
		{{ config('app.name') }}
	</p>
</body>
</html>