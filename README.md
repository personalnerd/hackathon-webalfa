# Meu IMC

Projeto para o Hackathon da [Pós-Graduação WebDev Alfa Umuarama](https://webdev.alfaumuarama.edu.br/)

Linguagens e frameworks escolhidos:

- PHP
- jQuery
- HTML/CSS/SASS
- Bootstrap

O sistema está publicado e funcionando no endereço https://personalnerd.net.br/meuimc

Para testar o sistema:

- User: admin
- Senha: 4dm1n\*

## Live Sass

A pasta `.vscode` deveria estar no `gitignore` para não ser versionada, mas eu mantive no projeto para mostrar a configuração utilizada com o plugin Live Sass que utilizo no VS Code. Assim mantenho os arquivos SCSS organizados em uma pasta enquanto aponto para o plugin criar os arquivos `.css` em uma pasta separada.

## Usuários, servidor, senhas...

O código do github está sem usuários e senhas reais, que estão publicados no servidor.

## Banco de dados

Banco de dados: `meuimc`

## Estrutura da tabela `imc`

```
CREATE TABLE `imc` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `height` float NOT NULL,
  `weight` float NOT NULL,
  `imc` float NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
```

## Estrutura da tabela `user`

```
CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `user_name` varchar(24) NOT NULL,
  `pwd` varchar(256) NOT NULL,
  `user_type_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
```

## Estrutura da tabela `user_type`

```
CREATE TABLE `user_type` (
  `id` int(11) NOT NULL,
  `user_type` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
```

## Índices para tabelas

Índices para tabela `imc`

```
ALTER TABLE `imc`
  ADD PRIMARY KEY (`id`);
```

Índices para tabela `user`

```
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_name` (`user_name`);
```

Índices para tabela `user_type`

```
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_type` (`user_type`);
```

## AUTO_INCREMENT de tabelas

AUTO_INCREMENT de tabela `imc`

```
ALTER TABLE `imc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
```

AUTO_INCREMENT de tabela `user`

```
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
```

AUTO_INCREMENT de tabela `user_type`

```
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
```
