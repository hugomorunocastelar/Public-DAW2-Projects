# Ej TextoOculto

![Portada](../imgs/portada.jpg)
Design by Freepik

### Autor

Hugo Moruno Parra  

Daw 2 - I.E.S Castelar

<div style="page-break-after: always;"></div>

# Enunciado

En ocasiones, subimos ficheros a servidores o nos descargamos ficheros a nuestro equipo, sin saber si vienen con alguna sorpresa. En este ejercicio, debéis encontrar un texto oculto en un fichero descargado.

Instrucciones para realizar el ejercicio:

  - Sube un fichero de texto con la resolución del ejercicio.
  - Debes descomprimir el fichero al disco duro y borrar el fichero descargado, una vez así, resuelve el ejercicio.
  - Debes encontrar un texto oculto. Muestra evidencias de cómo lo has conseguido (el fichero .EXE o comprimido no vale para resolver el ejercicio).
  - Documenta los pasos realizados.

# Texto

Éste es el código que Nos esconde el fichero.

```cmd
<assembly xmlns="urn:schemas-microsoft-com:asm.v1" manifestVersion="1.0">
<assemblyIdentity
  version="1.0.0.0"
  processorArchitecture="*"
  name="WinRAR SFX"
  type="win32"/>
<description>WinRAR SFX module</description>
<trustInfo xmlns="urn:schemas-microsoft-com:asm.v2">
  <security>
    <requestedPrivileges>
      <requestedExecutionLevel level="asInvoker"            
      uiAccess="false"/>
    </requestedPrivileges>
  </security>
</trustInfo>
<dependency>
  <dependentAssembly>
    <assemblyIdentity
      type="win32"
      name="Microsoft.Windows.Common-Controls"
      version="6.0.0.0"
      processorArchitecture="*"
      publicKeyToken="6595b64144ccf1df"
      language="*"/>
  </dependentAssembly>
</dependency>
<compatibility xmlns="urn:schemas-microsoft-com:compatibility.v1">
  <application>
    <!--The ID below indicates application support for Windows Vista -->
      <supportedOS Id="{e2011457-1546-43c5-a5fe-008deee3d3f0}"/>
    <!--The ID below indicates application support for Windows 7 -->
      <supportedOS Id="{35138b9a-5d96-4fbd-8e2d-a2440225f93a}"/>
    <!--The ID below indicates application support for Windows 8 -->
      <supportedOS Id="{4a2f28e3-53b9-4441-ba9c-d69d4a4a6e38}"/>
    <!--The ID below indicates application support for Windows 8.1 -->
      <supportedOS Id="{1f676c76-80e1-4239-95bb-83d0f6d0da78}"/>
    <!--The ID below indicates application support for Windows 10 -->
      <supportedOS Id="{8e0f7a12-bfb3-4fe8-b9a5-48fd50a15a9a}"/>
  </application>
</compatibility>
<asmv3:application xmlns:asmv3="urn:schemas-microsoft-com:asm.v3">
  <asmv3:windowsSettings xmlns="http://schemas.microsoft.com/SMI/2005/WindowsSettings">
    <dpiAware>true</dpiAware>
  </asmv3:windowsSettings>
</asmv3:application>
</assembly>

Debes intentar encontrar un texto que debes subir a ClassRoom y describir paso a paso lo que has hecho para encontrarlo.

Javier Merchán.
```

<div style="page-break-after: always;"></div>

# Explicación

Para encontrar el código oculto, he descomprimido el leeme.exe y buscado en él.

# Conclusión

Ejercicio entretenido e interesante que muestra lo "fácil" que es colar un código oculto.