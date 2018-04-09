var element = document.getElementById('new_div');

if (document.cookie == "") {
    console.log('Il n\'existe pas de cookie');
}
else {
	var cookie = document.cookie.split(';');
    cookie = cookie.map(el => el.trim());
	for (var i = 0; i < cookie.length ; i++) 
	{
		var currentDiv = document.getElementById("ft_list"); 
		var firstChild = currentDiv.firstChild;
        var c = readCookie(cookie[i][0]);
		var newDiv = document.createElement('div');
        newDiv.id = cookie[i][0];
    	newDiv.setAttribute('onclick','removeElt(this.id);');
		var task = document.createTextNode(c);
		newDiv.appendChild(task);
		currentDiv.insertBefore(newDiv, firstChild);
    }
}

function createCookie(name,value,days) {
	if (days) 
	{
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = "; expires="+date.toGMTString();
    }
    else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/";
}

function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) 
	{
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

function eraseCookie(name)
{
    createCookie(name,"",-1);
}


function max_value(array)
{
    var max = 0;
	for (var i = 0; i < array.length ; i++) 
	{
        if (array[i][0] > max)
            max = array[i][0];
    }
return max;
}

if (document.cookie)
{
    var i = max_value(cookie);
    i++;
}
else
    i = 0;
element.addEventListener('click', function()
{
	var todo_new = prompt("Please enter your to do");
	if (todo_new != null)
	{
		var currentDiv = document.getElementById("ft_list"); 
		var firstChild = currentDiv.firstChild;
		var newDiv = document.createElement('div');
		newDiv.id = i;
		newDiv.setAttribute('onclick','removeElt(this.id);');
		var task = document.createTextNode(todo_new);
		newDiv.appendChild(task);
		currentDiv.insertBefore(newDiv, firstChild);
		createCookie(newDiv.id , todo_new, 7);
	}
	i++;
});

function removeElt(id)
{
	if (confirm("Do you want to delete this to do?"))
	{
		var todo = document.getElementById('ft_list');
		var element = document.getElementById(id);
		todo.removeChild(element);
	}
	eraseCookie(id);
}
