# Flujo de trabajo con Git

Este repositorio usa dos ramas permanentes: `main` (código que se muestra en producción) y `dev` (integración del trabajo en curso). Toda otra rama es temporal: nace de `dev`, se integra mediante un pull request y se elimina. No se usan números de issue: la rama se identifica por su tipo, las iniciales de quien la hace y una descripción corta.

## Inicio rápido

1. Crear la rama desde `dev`:

```sh
git checkout dev
git pull
git checkout feat/mr-nueva-seccion-servicios
```

2. Publicarla y abrir un pull request a `dev`:

```sh
git add .
git commit -m "feat: agregar sección de servicios"
git push -u origin feat/mr-nueva-seccion-servicios
```

3. Después del merge, actualizar `dev` y borrar la rama:

```sh
git checkout dev
git pull --ff-only
git branch -d feat/mr-nueva-seccion-servicios
git push origin --delete feat/mr-nueva-seccion-servicios
```

## Convención de nombres

Formato: `<tipo>/<iniciales>-<slug>`

| Parte       | Regla                                            | Ejemplo                   |
| ----------- | ------------------------------------------------ | ------------------------- |
| `tipo`      | `feat`, `fix`, `refactor` u `hotfix`             | `feat`                    |
| `iniciales` | 2 o 3 letras, minúsculas, sin punto              | `mr`                      |
| `slug`      | 3 a 6 palabras en **kebab-case**, sin mayúsculas | `nueva-seccion-servicios` |

Ejemplos:

```text
feat/mr-nueva-seccion-servicios
fix/mr-password-eye
refactor/mr-limpia-front-controller
hotfix/mr-login-500
```

| Tipo        | Se crea desde | Se integra en          | Uso                               |
| ----------- | ------------- | ---------------------- | --------------------------------- |
| `feat/`     | `dev`         | `dev`                  | Funcionalidad nueva               |
| `fix/`      | `dev`         | `dev`                  | Corrección de un error            |
| `refactor/` | `dev`         | `dev`                  | Cambio interno sin cambio visible |
| `hotfix/`   | `main`        | `main` y después `dev` | Error urgente en lo ya publicado  |

Si todavía no hay nada publicado, un arreglo urgente es simplemente un `fix/`.

## Reglas

- `main` va a recibir cambios solo desde `dev`, o desde `hotfix/` cuando hay una urgencia. No se hacen commits ni pull requests directos a `main`.
- `dev` es la rama de integración y apunta al servidor de prueba; `main` apunta a producción.
- `dev` y `main` son nombres reservados: **no se usa `dev/` ni `main/` como prefijo**. Git guarda las ramas como rutas, así que `dev/confirmation-mail` convierte `dev` en una carpeta e impide crear la rama `dev` (`fatal: 'refs/heads/dev/confirmation-mail' exists; cannot create 'refs/heads/dev'`).
- Se usan minúsculas y guiones, nunca mayúsculas ni guiones bajos. Se evitan espacios y los caracteres `~ ^ : ? * [`, `..`, `@{`, guion al inicio y punto al final.
- Cada rama se borra después del merge, local y remotamente, para que no se acumulen ramas ya integradas.
