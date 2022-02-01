ARG IMAGE_REPO=ghcr.io/ilyes512/php81-fpm
ARG IMAGE_TAG_PHP_VSCODE=vscode-latest
FROM $IMAGE_REPO:$IMAGE_TAG_PHP_VSCODE

ARG USERNAME=code
ARG USER_UID=1000
ARG USER_GID=$USER_UID
ARG WORKSPACE_PATH=/workspace

RUN groupadd --gid "$USER_GID" "$USERNAME" \
    && useradd --uid "$USER_UID" --gid "$USER_GID" --create-home "$USERNAME" \
    && mkdir -p \
        "$WORKSPACE_PATH" \
        "/home/$USERNAME/.vscode-server/extensions" \
    && chown -R "$USER_UID":"$USER_GID" \
        "$WORKSPACE_PATH" \
        "/home/$USERNAME/.vscode-server" \
    && echo "$USERNAME" ALL=\(root\) NOPASSWD:ALL > "/etc/sudoers.d/$USERNAME" \
    && chmod 0440 "/etc/sudoers.d/$USERNAME"

WORKDIR $WORKSPACE_PATH

CMD ["docker-cmd.sh"]
