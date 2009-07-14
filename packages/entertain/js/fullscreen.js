function open_fullscreen_window(target_url)
{
  alert('För att få riktig fullskärm trycker du på F11 på ditt tangentbord, när du vill tillbaks till fönsterläge håller du inne ALT-knappen och trycker på F4!');
  var sc_width = screen.width;
  var sc_height = screen.height;
  window.open(target_url, 'fullscreen_window', 'width=' + sc_width + ', height=' + sc_height + ', toolbar=no, location=no');
}