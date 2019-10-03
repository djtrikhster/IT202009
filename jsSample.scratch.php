<html>
	<head>
	<!--css and js here -->
		<script>
			alert("Hello World")
			var myVariable;
			let myOtherVariable
			//var body = document.getElementByTagName('body');
			var divEl = document.createElement('div');
			divEl.style.cssText('background-color:red');
			document.body.appendChild(divEl);
			myVariable = prompt("What's your name?");
			alert("Hello, " + myVariable);
		</script>
	</head>
	<body>
	<!-- html content here -->
		<p> It loaded yay! </p>
		<div style="background-color:green">
			<p>"the background is green"</p>
		</div>
		<div>
			<p>"added new element" </p>
		</div>
	</body>
</html>

