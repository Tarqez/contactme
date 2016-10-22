# ContactMe

Simple PHP file to upload to the web-server (typically a shared host server) to let _contact_ form pages (typycally of static websites) send an email to the website owner.

No dependencies, just set few config parameter and focus on the HTML FORM.

## Building the FORM page

Forget how your _contact_ page will be emaild and focus on building the FORM with verbose and expressive __name__ attributes for __input__ elements. For example:

> &lt;label for="birtday">When were you born&lt;/input>
> &lt;input type="text" id="birtday" name="Date of birth"> 

Only keep in mind that the email input element must have __name="email"__, that is the value of name attribute must be __name__ in lowercase.

## How it works

Form is sent by POST method to contactme.php that builds the email, sends it and redirects to a response web-page with anchors, one for each result. Note that the form page and the response page can be the same and that anchors can be managed by JS modal windows.


### TO DO

Email a HTML-form and redirect to a response page with anchors, one for each result.
The form page and the response page can be the same.
Anchors can be managed by JS modal windows.