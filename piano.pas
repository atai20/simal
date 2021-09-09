uses graphABC, ABCobjects;
var
u,k:integer;
do1:=261;
re:=293;
mi:=329;
pha:=349;
sol:=392;
la:=440;
si:=493;
procedure keydown(key:integer);
begin
 if key=vk_q then begin
 system.Console.Beep(do1,200);
 write('do,');
 end;
  if key=vk_w then begin
   system.Console.Beep(re,200);
    write('re,');
 end;
  if key=vk_e then begin
   system.Console.Beep(mi,200);
    write('mi,');
 end;
  if key=vk_r then begin
   system.Console.Beep(pha,200);
    write('pha,');
 end;
  if key=vk_t then begin
   system.Console.Beep(sol,200);
    write('sol,');
 end;
   if key=vk_y then begin
    system.Console.Beep(la,200);
     write('la,');
 end;
   if key=vk_u then begin
    system.Console.Beep(si,200);
     write('si,');
 end;
end;


begin
onkeydown:=keydown;
end.