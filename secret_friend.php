<?php
	/**
	 * @author Pedro Costa
	 * @since 12/21/2015
	 * PHP script to create matches for a secret friend game (raffling the pairs)
	 * It prevents the creation of non-sense pairs (duplicated, paired with itself, person without a pair)
	 */

	echo "<h4>Sorteio Amigo Oculto (PT-BR)/Secret Friend Raffling (ENG)</h4>";
	
	// Participants. Called as friends
	// TODO Change it with your participants
	$friends = array('Pedro I', 'Sam Zhao', 'Pedro II', 'Jack', 'Marcela');

	// Matches array to store a matching friend for each participant
	// TODO Change it with your participants
	$matches = array(
		'Pedro I' => '', 
		'Sam Zhao' => '', 
		'Pedro II' => '', 
		'Jack' => '', 
		'Marcela' => ''
	);	

	// Array to store who's been already taken
	$taken = array();
	
	// Shuffling the list of friends
	shuffle($friends);
	
	// .. Debugging ..
	echo '<pre><br/>$friends array: <br/>';
	var_dump($friends);
	
	// Magic starts in here!
	foreach($friends as $currentFriend){
		
		if( empty($matches[$currentFriend]) || $matches[$currentFriend] == '' ){ // Current friend does not have a match yet
			
			// Finds a match for the current guy as long as it is not him/herself
			$random = mt_rand(0, (count($friends)-1) ); // random index in the list of friends from 0 to 4
			echo "random for ". $currentFriend .": ". $random ." '". $friends[$random] ."' (1st attempt)<br/>";

			while($friends[$random] === $currentFriend || in_array($friends[$random], $taken) ){
				$random = mt_rand(0, (count($friends)-1) ); // random index in the list of friends from 0 to 4
				echo "random for ". $currentFriend .": ". $random ." '". $friends[$random] ."' (further attempt)<br/>";
			}
			
			// Sets the new match for the current friend
			$secretFriendMatched = $friends[$random];
			
			// Add the match to current friend's record and to matched friend's record
			$matches[$currentFriend] = $secretFriendMatched;
				
			$taken[] = $secretFriendMatched;
		}
	}
	
	// .. Debugging ..
	echo "<br/>Matches: <br/>";
	var_dump($matches);
?>