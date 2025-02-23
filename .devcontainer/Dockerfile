ARG IMAGE_REGISTRY_PHP
ARG IMAGE_TAG_PHP
FROM $IMAGE_REGISTRY_PHP:$IMAGE_TAG_PHP

ARG USER=code
ARG GROUP=code
ARG USER_UID=1000
ARG USER_GID=$USER_UID
ARG WORKSPACE_PATH=/workspace
ARG TARGETARCH

# Latest version: https://github.com/boxboat/fixuid/releases
ENV FIXUID_VERSION=0.6.0

RUN curl -fsSLo /tmp/fixuid.tar.gz "https://github.com/boxboat/fixuid/releases/download/v$FIXUID_VERSION/fixuid-${FIXUID_VERSION}-linux-${TARGETARCH}.tar.gz" \
    && tar -xf /tmp/fixuid.tar.gz -C /usr/local/bin fixuid

RUN apt-get update \
    && apt-get install --assume-yes --no-install-recommends \
        openssh-client \
        sudo \
    && apt-get autoremove --assume-yes \
    && apt-get clean --assume-yes \
    && rm -rf /var/lib/apt/lists/*

RUN groupadd --gid "$USER_GID" "$USER" \
    && useradd --uid "$USER_UID" --gid "$USER_GID" --create-home "$USER" --shell /bin/bash \
    && mkdir -p \
        /etc/fixuid \
        "$WORKSPACE_PATH" \
        "/home/$USER/.vscode-server/extensions" \
        "/home/$USER/.composer" \
    && chown -R "$USER_UID":"$USER_GID" \
        "$WORKSPACE_PATH" \
        "/home/$USER/.vscode-server" \
        "/home/$USER/.composer" \
    && echo "$USER" ALL=\(root\) NOPASSWD:ALL > "/etc/sudoers.d/$USER" \
    && chmod 0440 "/etc/sudoers.d/$USER" \
    && printf "user: $USER\ngroup: $GROUP\npaths:\n  - /var/www\n  - /home/$USER\n\n" > /etc/fixuid/config.yml

WORKDIR $WORKSPACE_PATH

ENV PATH=$PATH:${WORKSPACE_PATH}/vendor/bin
