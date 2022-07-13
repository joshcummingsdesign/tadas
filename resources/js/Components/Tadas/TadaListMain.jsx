/** @jsxImportSource @emotion/react */
import React, { Fragment, useEffect, useState } from "react";
import Tada from "@/Components/Tadas/Tada";
import { css } from "@emotion/react";
import AddButton from "@/Components/AddButton";
import { Inertia } from "@inertiajs/inertia";
import { useTheme, Container, Typography, Stack } from "@mui/material";
import BareTextInput from "@/Components/Form/BareTextInput";

/**
 * The max width of the tada items.
 *
 * @unreleased
 */
const tadaMaxWidth = "500px";

/**
 * TadaListMain component.
 *
 * @unreleased
 */
export default function TadaListMain({ tadaList, tadas }) {
  const [titleText, setTitleText] = useState("");
  const [isEditingTitle, setIsEditingTitle] = useState(false);
  const theme = useTheme();

  useEffect(() => {
    setTitleText(tadaList ? tadaList.name : "");
  }, [tadaList]);

  const addTada = (tada_list_id) => {
    Inertia.post(
      route("tadas.store"),
      {
        name: "Untitled Tada",
        tada_list_id,
      },
      { replace: true }
    );
  };

  const handleTitleChange = (e) => {
    setTitleText(e.target.value);
  };

  const handleTitleFocus = () => {
    setIsEditingTitle(true);
  };

  const handleCancel = () => {
    setIsEditingTitle(false);
    setTitleText(tadaList.name);
  };

  const handleTitleUpdate = () => {
    const name = titleText || "Untitled List";

    setIsEditingTitle(false);
    setTitleText(name);

    Inertia.patch(
      route("tadaLists.update", tadaList.id),
      { name },
      { replace: true }
    );
  };

  const handelKeyDown = (e) => {
    if (e.key === "Enter") {
      handleTitleUpdate();
    }

    if (e.key === "Escape") {
      handleCancel();
    }
  };

  return (
    <section
      css={css`
        padding: 24px 0;
        height: calc(100vh - 56px);
        width: 100%;
        overflow-y: auto;
        background-color: ${theme.palette.mode === "light"
          ? "rgba(0,0,0,0.03)"
          : "rgba(255,255,255,0.03)"};

        ${theme.breakpoints.up("sm")} {
          height: calc(100vh - 64px);
        }

        ${theme.breakpoints.up("md")} {
          width: calc(100% - 300px);
        }
      `}
    >
      <Container>
        {tadaList && (
          <Fragment>
            {isEditingTitle ? (
              <BareTextInput
                css={css`
                  margin-bottom: 30px;
                `}
                variant="h1"
                autoFocus={true}
                onBlur={handleTitleUpdate}
                onKeyDown={handelKeyDown}
                onChange={handleTitleChange}
                value={titleText}
              />
            ) : (
              <Typography
                variant="h1"
                css={css`
                  margin-bottom: 30px;
                `}
                onClick={handleTitleFocus}
                onFocus={handleTitleFocus}
                tabIndex={0}
              >
                {titleText}
              </Typography>
            )}
            <Stack spacing={3}>
              {tadas.map((tada) => (
                <Tada
                  css={css`
                    max-width: ${tadaMaxWidth};
                  `}
                  key={tada.id}
                  tada={tada}
                />
              ))}
              <AddButton
                css={css`
                  max-width: ${tadaMaxWidth};
                `}
                onClick={() => addTada(tadaList.id)}
                disablePadding={true}
                autoFocus={true}
              />
            </Stack>
          </Fragment>
        )}
      </Container>
    </section>
  );
}
