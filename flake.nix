{
  inputs = {
    nixpkgs.url = "github:NixOS/nixpkgs/nixos-25.11";
    flake-parts.url = "github:hercules-ci/flake-parts";
  };

  outputs =
    inputs@{
      self,
      nixpkgs,
      flake-parts,
    }:
    flake-parts.lib.mkFlake { inherit inputs; } {
      systems = [
        "x86_64-linux"
      ];

      perSystem =
        { pkgs, self', ... }:
        {
          packages.default = pkgs.stdenv.mkDerivation {
            name = "danmharrs-website";
            src = ./.;

            nativeBuildInputs = with pkgs; [
              hugo
            ];

            buildPhase = ''
              hugo
            '';

            installPhase = ''
              mkdir -p $out/dist
              cp -r public/* $out/dist/
            '';
          };

          packages.format = pkgs.writeShellScriptBin "format" ''
            ${pkgs.prettier}/bin/prettier --plugin=${pkgs.prettier-plugin-go-template}/lib/node_modules/prettier-plugin-go-template/lib/index.js --write .
          '';

          devShells.default = pkgs.mkShell {
            packages = with pkgs; [
              hugo
            ];
          };
        };
    };
}
