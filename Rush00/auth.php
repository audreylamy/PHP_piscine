<?PHP
session_start();
function auth($login, $passwd, $requete)
{
	$passwd_hashed = hash('whirlpool', $passwd);
	while ($data = mysqli_fetch_array($requete))
	{
		if ($data['login'] === $login && $data['password'] === $passwd_hashed)
		{
			return TRUE;
		}
	}
	return FALSE;
}

function admin($login, $passwd, $requete)
{
	$passwd_hashed = hash('whirlpool', $passwd);
	while ($data = mysqli_fetch_array($requete))
	{
		if ($data['login'] === $login && $data['password'] === $passwd_hashed)
		{
			return TRUE;
		}
	}
	return FALSE;
}

function login($info, $requete)
{
	while ($data = mysqli_fetch_array($requete))
	{
		if ($data['login'] === $info)
		{
			return TRUE;
		}
	}
	return FALSE;
}

function email($info, $requete)
{
	while ($data = mysqli_fetch_array($requete))
	{
		if ($data['email'] === $info)
		{
			return TRUE;
		}
	}
	return FALSE;
}

$sql_produit = "SELECT nom, prix FROM produits";
$requete_produit = mysqli_query($link, $sql_produit); 

?>