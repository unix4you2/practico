

CREATE TABLE "core_auditoria" (
  "id" integer NOT NULL PRIMARY KEY AUTOINCREMENT,
  "usuario_login" text NOT NULL,
  "accion" text NOT NULL,
  "fecha" text NOT NULL,
  "hora" text NOT NULL
);


CREATE TABLE "core_backups" (
  "id" integer NOT NULL PRIMARY KEY AUTOINCREMENT,
  "usuario_login" text NOT NULL,
  "archivo_backup" text NOT NULL,
  "archivo_original" text NOT NULL,
  "fecha" text NOT NULL,
  "hora" text NOT NULL
);
