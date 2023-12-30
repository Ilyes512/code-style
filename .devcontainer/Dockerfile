ARG IMAGE_REGISTRY_PHP
ARG IMAGE_TAG_PHP_VSCODE
FROM $IMAGE_REGISTRY_PHP:$IMAGE_TAG_PHP_VSCODE

ARG USERNAME=code
ARG USER_UID=1000
ARG USER_GID=$USER_UID
ARG WORKSPACE_PATH=/workspace

RUN groupadd --gid "$USER_GID" "$USERNAME" \
    && useradd --uid "$USER_UID" --gid "$USER_GID" --create-home "$USERNAME" --shell /bin/bash \
    && mkdir -p \
        "$WORKSPACE_PATH" \
        "/home/$USERNAME/.vscode-server/extensions" \
    && chown -R "$USER_UID":"$USER_GID" \
        "$WORKSPACE_PATH" \
        "/home/$USERNAME/.vscode-server" \
    && echo "$USERNAME" ALL=\(root\) NOPASSWD:ALL > "/etc/sudoers.d/$USERNAME" \
    && chmod 0440 "/etc/sudoers.d/$USERNAME"

WORKDIR $WORKSPACE_PATH

ENV PATH=$PATH:${WORKSPACE_PATH}/vendor/bin

CMD ["docker-cmd.sh"]
