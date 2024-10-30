/** to get cookie value */
function crmio_getcookie(name) {
  var cookie_name = name + "=";
  var cookies = document.cookie.split(";");
  for (var i = 0; i < cookies.length; i++) {
    var extracted_cookie = cookies[i];
    while (extracted_cookie.charAt(0) == " ")
      extracted_cookie = extracted_cookie.substring(1, extracted_cookie.length);
    if (extracted_cookie.indexOf(cookie_name) == 0)
      return extracted_cookie.substring(
        cookie_name.length,
        extracted_cookie.length
      );
  }
  return null;
}

jQuery(document).ready(function ($) {
  var crmio_id = 0;
  jQuery("a").each(function (idx) {
    if (
      jQuery(this).attr("href") == "admin.php?page=crmio/classes/class.crmioplugin_crmio.php"
    ) {
      if (crmio_id == 1) {
        jQuery(this).css("display", "none");
      }
      crmio_id++;
    }
  });
  /** to show other apps  **/
  var id1 = 0;
  jQuery("a").each(function (idx) {
    if (
      jQuery(this).attr("href") == "admin.php?page=Other"
    ) {
      jQuery(this).addClass("show_popup_crmio");
      jQuery(this).attr("href", "#");
      jQuery(this).attr("id", "show_popup_crmio");
      id1++;
    }
  });
  /** to close other apps  **/
  var modal = document.getElementById("crmioModal");
  var btn = document.getElementById("show_popup_crmio");
  var span = document.getElementsByClassName("close")[0];
  btn.onclick = function () {
    modal.style.display = "block";
  };
  span.onclick = function () {
    modal.style.display = "none";
  };
  window.onclick = function (event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  };
});