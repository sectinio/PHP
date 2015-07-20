<?php if ($usertype=='Administrator')
							{
									  echo('<a href=contul_meu.php>Acasa</a>
									| <a href=lista_grup_teste.php>Grup teste</a>
									| <a href="lista_teste.php">Teste</a>
									| <a href="lista_intrebari.php">Intrebari</a> 
									| <a href="rezultate_main.php">Rezultate</a>  
									| <a href="activeaza_utilizator.php">Utilizatori</a> 
									| <a href="sugestie_admin.php">Sugestii</a> 
									| <a href="logout.php">Logout</a>');
									
							}
						
							if ($usertype=='Profesor')
							{
									  echo('<a href=contul_meu.php>Acasa</a>
									| <a href=lista_grup_teste.php>Grup teste</a>
									| <a href="lista_teste.php">Teste</a>
									| <a href="lista_intrebari.php">Intrebari</a> 
									| <a href="rezultate_main.php">Rezultate</a>  
									| <a href="editeaza_profil.php">Profilul meu</a> 
									| <a href="activeaza_utilizator_student.php">Studenti</a> 
									| <a href="sugestie.php">Sugestii</a> 
									| <a href="logout.php">Logout</a>');
									
							}
							if ($usertype=='Student')
							{
									  echo('<a href=contul_meu.php>Acasa</a>
									| <a href="start_lista_teste.php">Start test</a> 
									| <a href="editeaza_profil.php">Profilul meu</a> 
									| <a href="rezultate_main.php">Rezultate</a> 
									| <a href="sugestie.php">Sugestii</a> 
									| <a href="logout.php">Logout</a>');
									
							}
?>