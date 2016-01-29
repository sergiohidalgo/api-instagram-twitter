# Prueba de back-end
Para probar tus conocimientos tenemos una pequeña prueba que puedes hacer en un par de horas. Las herramientas (frameworks, librerías, etc) que utilices son a tu criterio.

- Crear una API REST que contenga 2 rutas: `/posts/` y `/posts/likes`,  ambas vía `GET`.
- Ambas deben entregar un combinado de posts de **instagram** y **twitter**, buscando el hashtag **#meat**. 
- Los resultados deben ser ordenados por **fecha** para `/posts/` y por **likes** en  `posts/likes`. 
- Esto se debe poder consumir desde un front end en cualquier dominio.
- Subir tu respuesta a github.

La estructura del json debería ser como la siguiente:

```javascript
[
	{
		"type": "instagram",
		"content": "{URL_IMAGEN} + {TEXTO_DESCRIPCIÓN}",
		"date": "DD/MM/YYYY h:m:s",
		"likes": 10
	},
	{
		"type": "twitter",
		"content": "{TEXTO_DESCRIPCIÓN}",
		"date": "DD/MM/YYYY h:m:s",
		"likes": 3
	}
	//...
]
```
