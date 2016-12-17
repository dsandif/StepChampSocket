<?php 	
	set_time_limit(0);
	$ip = "127.0.0.1";
	$port = 1234;

	if ($socket = socket_create(AF_INET, SOCK_STREAM, 0)) {
		showError(); 
	}

	echo "The sockets protocol info was set \n";

	if (!socket_bind($socket, $ip, $port)) {
		showError($socket);
	}

	echo "The socket has been bound to s specific port \n";

	if (!socket_listen($socket)) {
	showError($socket);
	}

	echo "Now listening for connections * * * \n";

	do {

		$client = socket_accept($socket);
		$message = "New connection has been establiished \n";

		#Welcome the user
		echo "\ Welcome to Step Champ";

		socket_write($client, $message, strlen($message));

		do {
			if (!$clientMsg = socket_read($client, 2048, PHP_NORMAL_READ)) {
				showError($socket);
			}

			$messageForUser = "Thanks for using StepChamp";
			socket_write($client, $messageForUser,strlen($messageForUser));

			if (!$clientMsg = trim($clientMsg)) {
				continue;
			}
			if ($clientMsg = 'close') {
				socket_close($client);
				echo "socket was closed by client";

				break 2;
			}

		} while (true);
		
	} while (true);

	echo "Now ending the socket - - - ";
	socket_close($socket);


	function showError($socket)
	{
		$errCode = socket_last_error($socket);
		$errMsg = socket_strerror($errCode)
	}
?>